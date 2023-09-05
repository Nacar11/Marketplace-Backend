<?php

namespace App\Http\Controllers;
use App\Models\UserPaymentMethod;
use App\Http\Requests\UserPaymentMethodRequest;


use Illuminate\Http\Request;

class UserPaymentMethodController extends Controller
{
    public function __invoke()
    {
        $userPaymentMethods = UserPaymentMethod::all();

        return response()->json($userPaymentMethods);
    }

    public function update(UserPaymentMethodRequest $request)
    {
    $userPaymentMethod = UserPaymentMethod::where('user_id', auth()->user()->id)->first();

    if (!$userPaymentMethod) {
        return response()->json(['message' => 'User payment method not found'], 404);
    }

    // The request is already validated by the UserPaymentMethodRequest class

    // Update the user payment method with the validated data
    $userPaymentMethod->update($request->validated());

    return response()->json(['message' => 'User payment method updated successfully']);
    }

    public function getUPMbyID()
    {
        $userId = auth()->user()->id;
        // Retrieve user payment methods for the specified user ID
        $userPaymentMethods = UserPaymentMethod::where('user_id', $userId)->get();

        return response()->json($userPaymentMethods);
    }
}
