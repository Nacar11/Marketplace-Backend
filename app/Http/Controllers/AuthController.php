<?php

namespace App\Http\Controllers;


use App\Http\Resources\UserResource;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Models\ShoppingCart;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller{


    public function __invoke()
    {
        $users = User::with('shoppingCart')->get();    
        return $users;
    }

    public function login(Request $request){
        $credentials = $request->validate([
            'email' => 'required|string|email|exists:users,email',
            'password' => 'required|string',
            'remember' => 'boolean'
        ]);

        $remember = $credentials['remember'] ?? false;
        unset($credentials['remember']);

        if (!Auth::attempt($credentials, $remember)){
            return response ([
                'error' => 'Invalid Credentials'
            ], 422);
        }
        $user = Auth::user();
        $token = $user->createToken('auth-token')->plainTextToken;
        $user->load('shoppingCart');
        // dd($user);
        return response()->json([ 
            'Message'=> 'Authorized',
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => null,
            'username' => $user->username,
            'user_id' => $user->id,
            'shopping_cart' => $user->shoppingCart
            ]);     
        }

    public function logout(){
        auth()->user()->tokens()->delete();
        return response()->json(['Success' => 'Logged out']);
    }

    public function register(UserRequest $request){
        $validatedData = $request->validated(); 
        $user = User::create($validatedData);
        
        if (!$user->shoppingCart) {
            $shoppingCart = ShoppingCart::create([
                'user_id' => $user->id,
            ]);
        }
        return response()->json([ 
            'Message'=> 'Success',
            'User' => $user,
            ]);     
        }

    



    public function getShoppingCartByUser($id){

        $user = User::find($id); 
        if (!$user) {
            return "User Not Found"; 
        }
        $shoppingCart = $user->shoppingCart;
        if (!$shoppingCart) {
            return "Shopping Cart Not Found."; 
        }
        $shoppingCart->load('items.productItem.productImages', 'items.variationOptions', 'items.productItem.product');

    
        return $shoppingCart;
        }
    }