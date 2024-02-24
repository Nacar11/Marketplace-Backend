<?php

namespace App\Http\Controllers;
use App\Http\Requests\AddressRequest;
use Illuminate\Http\Request;
use App\Models\Address;
use App\Models\UserAddress;

class AddressController extends Controller
{
    public function store(AddressRequest $request)
    {
        try {
            $validatedData = $request->validated();

            // Create a new address
            $address = Address::create([
                'contact_number'=> $validatedData['contact_number'],
                'unit_number' => $validatedData['unit_number'],
                'address_line_1' => $validatedData['address_line_1'],
                'address_line_2' => $validatedData['address_line_2'],
                'city_id' => $validatedData['city_id'],
                'region_id' => $validatedData['region_id'],
                'postal_code' => $validatedData['postal_code'],
                'country_id' => $validatedData['country_id'],
            ]);

             // Check if the user has any existing addresses
            $existingUserAddressesCount = auth()->user()->userAddresses()->count();

            // Set is_default to true if the user doesn't have any existing addresses
            $isDefault = $existingUserAddressesCount === 0;

            $userAddress = UserAddress::create([
                'user_id' => auth()->user()->id, 
                'address_id' => $address->id,
                'is_default' => $isDefault,
            ]);

            return response()->json([
                'message' => 'success',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'error',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

public function getAddresses()
{
    try {
        $userId = auth()->user()->id;

       
        $userAddresses = UserAddress::where('user_id', $userId)
                                  ->with('address.country', 'address.region', 'address.city')
                                  ->get();

        if (!$userAddresses) {
            return response()->json([
                'message' => 'error',
                'data' => null,
            ]);
        }

        return response()->json([
            'message' => 'success',
            'data' => $userAddresses,
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'message' => 'error',
            'error' => $e->getMessage(),
        ], 500);
    }
}
public function userHasAddress()
{
    try {
        $userId = auth()->user()->id;

        $userAddresses = Address::whereHas('userAddresses', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->get();

        if ($userAddresses->isEmpty()) {
            return response()->json([
                'message' => false,
            ]);
        }

        return response()->json([
            'message' => true,
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'message' => false,
        ], 500);
    }
}
    public function deleteAddress($addressId)
    {
        try {
            $address = Address::findOrFail($addressId);

           
            $address->delete();

            return response()->json([
                'message' => 'success',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'error',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function setDefaultAddress($addressId)
{
    try {
        // Get the address associated with the given addressId
        $address = Address::findOrFail($addressId);

        // Get the user's default address
        $defaultUserAddress = UserAddress::where('user_id', auth()->user()->id)
            ->where('is_default', true)
            ->first();

        // If there is a default address, set it to false
        if ($defaultUserAddress) {
            $defaultUserAddress->update(['is_default' => false]);
        }

        // Get the user_address for the specified address
        $userAddress = UserAddress::where('user_id', auth()->user()->id)
            ->where('address_id', $address->id)
            ->first();

        // Update the specified user_address to true
        $userAddress->update(['is_default' => true]);

        return response()->json([
            'message' => 'success',
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'message' => 'error',
            'error' => $e->getMessage(),
        ], 500);
    }
}

}
