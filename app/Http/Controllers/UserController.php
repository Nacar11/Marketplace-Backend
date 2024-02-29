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

  
    public function getUserData(Request $request)
    {
        try {
            $userId = auth()->user()->id;
            $user = User::find($userId);
            if (!$user) {
                return response()->json(['message' => 'User not found'], 404);
            }

            return response()->json(['message' => 'success', 'data' => $user]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'error', 'error' => $e->getMessage()], 500);
         }
    }
    public function getUserGender()
    {
        $userId = auth()->user()->id;
        $user = User::find($userId);
        if ($user && $user->gender) {
            return response()->json(['message' => 'success', 'data' => $user->gender]);
        } else {
            return null;
        }
    }
}