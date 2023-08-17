<?php

namespace App\Http\Controllers;

use App\Models\ShoppingCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShoppingCartController extends Controller
{
    public function createCart()
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login'); // Redirect to login if user is not authenticated
        }

        // Create a new shopping cart for the user
        ShoppingCart::create([
            'user_id' => $user->id,
        ]);

        return redirect()->route('home'); // Redirect to home page after creating cart
    }
    
    // public function getShoppingCartItemsByCart($id)
    // {
    //     $shoppingCart = ShoppingCart::find($id); 

    //     if (!$shoppingCart) {
    //         return response()->json(['error' => 'Shopping cart not found'], 404);
    //     }

    //     return $shoppingCart->items;
    // }
}
