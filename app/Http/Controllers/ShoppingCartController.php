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
    
    public function deleteShoppingCartItemByCart($itemID, $cartID)
    {
        // Find the shopping cart based on its ID
        $shoppingCart = ShoppingCart::findOrFail($cartID);
    
        // Find the shopping cart item within the specified shopping cart
        $shoppingCartItem = $shoppingCart->items()->findOrFail($itemID);
    
        // Delete the shopping cart item
        $shoppingCartItem->delete();
    
        return response()->json(['message' => 'Success']);
    }
}
