<?php

namespace App\Http\Controllers;


use App\Http\Resources\UserResource;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller{

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

        return response()->json([
                    
            'Message'=> 'Authorized',
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => null,
            'username' => $user->username
        
]);


       
    }
    public function logout(){
        // $user = Auth::user();
        // $user->currentAccessToken()->delete();
        // return response([
        //     'success' => true
        // ]);
        auth()->user()->tokens()->delete();
        return response()->json(['Success' => 'Logged out']);
    }
    public function register(UserRequest $request){
        $validatedData = $request->validated();
        $validatedData['credits'] = 0; // Set credits to 0
        
        $user = User::create($validatedData);
        
        return response()->json([
            'status' => "Success",
            'Body' => $user,
        ], 200);
        }
        
    

            // $user = User::create([
            //     'first_name' => ucwords(strtolower($fields['first_name'])),
            //     'last_name' => ucwords(strtolower($fields['last_name'])),
            //     'contact_number' => $fields['contact_number'],
            //     'email' => $fields['email'],
            //     'password' => Hash::make($fields['password']),


            // ]);
    }