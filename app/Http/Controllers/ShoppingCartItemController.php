<?php

namespace App\Http\Controllers;
use App\Models\ShoppingCartItem;
use Illuminate\Http\Request;
use App\Http\Requests\ShoppingCartItemRequest;

class ShoppingCartItemController extends Controller
{

    public function getCartItemByID($id)
    {
        return ShoppingCartItem::with('variationOptions')->find($id);
    }
    public function __invoke()
    {
        return ShoppingCartItem::with('variationOptions')->get();
    }
    public function addToCart(ShoppingCartItemRequest $request)
    {
    $user = auth()->user();
    $cart = $user->shoppingCart;
    $cartId = $cart->id;

    $validatedData = $request->validated();

    $shoppingCartItem = new ShoppingCartItem([
        'cart_id' => $cartId,
        'product_item_id' => $validatedData['product_item_id'],
    ]);
    $shoppingCartItem->save();

    $response = [
        'message' => 'success',
    ];

    return response()->json($response);
    }       
}
        
//update