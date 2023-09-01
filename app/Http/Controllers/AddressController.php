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
            // Validated data will be available from the $request object
            $validatedData = $request->validated();

            // Create a new address
            $address = Address::create($validatedData);

            $userAddress = UserAddress::create([
                'user_id' => auth()->user()->id, // You may need to change this depending on how you manage user authentication
                'address_id' => $address->id,
                'is_default' => false, // You may need to adjust this value
            ]);

            return response()->json([
                'message' => 'Success',
                'data' => $address,
                'user_address' => $userAddress,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function getAddress()
    {
        try {
            $userId = auth()->user()->id;

            // Retrieve user addresses with their associated addresses
            $userAddresses = UserAddress::where('user_id', $userId)
                ->with('address')
                ->get();

            return response()->json([
                'message' => 'Success',
                'data' => $userAddresses,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error',
                'error' => $e->getMessage(),
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
