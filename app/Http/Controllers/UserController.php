<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Http\Resources\UserResource;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Models\ShoppingCart;
use App\Models\UserPaymentMethod;
use Carbon\Carbon;
use Illuminate\Http\Request;








class UserController extends Controller{

    public function __invoke()
        {
            print("asdasd");
        }
     public function getUserData(Request $request)
        {
            try {
                $userId = auth()->user()->id;

                // Retrieve the user based on the user ID
                $user = User::find($userId);

                if (!$user) {
                    return response()->json(['message' => 'User not found'], 404);
                }

               

                return response()->json(['message' => 'success', 'userData' => $user]);
            } catch (\Exception $e) {
                return response()->json(['message' => 'Error', 'error' => $e->getMessage()], 500);
            }
        }
}