<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use Exception;
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
            'message'=> 'Authorized',
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
        try {
        $validatedData = $request->validated(); 
        $userData = User::create($validatedData);
        // dd($userData);
        $shoppingCart = null; 

        if (!$userData->shoppingCart) {
            $shoppingCart = ShoppingCart::create([
                'user_id' => $userData->id,
            ]);
        }
        $userData = User::with('shoppingCart')->find($userData->id);

        $token = $userData->createToken('auth-token')->plainTextToken;
        
        return response()->json([ 
            'message'=> 'Success',
            // 'User' => $userData,
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => null,
            'username' => $userData->username,
            'user_id' => $userData->id,
            'ShoppingCart' => $shoppingCart,
            ]);     
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Error',
                'error' => $e->getMessage(),
            ], 500);
        }
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
        $shoppingCart->load('items.productItem.productImages', 'items.productItem.product', 'items.productItem.variationOptions.variation');

    
        return $shoppingCart;
        }
    

    public function getUser(){

        $userId = auth()->user();
        if (!$userId) {
            return "User Not Found"; 
        }
       
    
        return $userId;
        }

    public function facebookpage(){
        // return Socialite::driver('facebook')->stateless()->user();
        return response()->json([
            'redirect_url' => Socialite::driver('facebook')->stateless()->redirect()->getTargetUrl()
        ]);
    }

    public function googleRedirect(Request $data){
        try {
            $user = User::where('email', $data->email)->first();
            if ($user) {
                // User with the provided email was found, log them in
                Auth::login($user);
    
                // Generate token
                $token = $user->createToken('auth-token')->plainTextToken;
    
                return response()->json([ 
                    'message' => 'Success',
                    'access_token' => $token,
                    'token_type' => 'Bearer',
                    'expires_in' => null,
                    'username' => $user->username,
                    'user_id' => $user->id,
                    'shopping_cart' => $user->shoppingCart
                ]);
            }
             else {
                // No user found with the provided email
                return response()->json(['message' => 'registerFirst']);
            }
        } catch (\Exception $e) {
            // Handle exceptions if they occur
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}