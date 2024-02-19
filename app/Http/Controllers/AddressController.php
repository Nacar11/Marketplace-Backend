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

public function getAddress()
{
    try {
        $userId = auth()->user()->id;

        // Retrieve the default user address with associated details
        $userAddress = UserAddress::where('user_id', $userId)
                                  ->with('address.country', 'address.region', 'address.city')
                                  ->first();

        if (!$userAddress) {
            return response()->json([
                'message' => 'Error',
                'data' => null,
            ]);
        }

        return response()->json([
            'message' => 'success',
            'data' => $userAddress,
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'message' => 'Error',
            'error' => $e->getMessage(),
        ], 500);
    }
}
public function userHasAddress()
{
    try {
        $userId = auth()->user()->id;

        // Retrieve addresses associated with the user
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
    public function destroy($userAddressId)
    {
        try {
            $userAddress = UserAddress::findOrFail($userAddressId);

            // Delete the user address
            $userAddress->delete();

            return response()->json([
                'message' => 'User address deleted successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

}
