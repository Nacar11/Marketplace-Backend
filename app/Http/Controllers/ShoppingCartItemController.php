<?php

namespace App\Http\Controllers;
use App\Models\ShoppingCartItem;
use Illuminate\Http\Request;
use App\Http\Requests\ShoppingCartItemRequest;

class ShoppingCartItemController extends Controller
{

    public function __invoke()
    {
    $user = auth()->user();

    $cartItems = ShoppingCartItem::with([
        'productItem.product.productCategory',
        'productItem.productImages',
        'productItem.productConfigurations.variationOption.variation'
    ])
    ->whereHas('cart', function ($query) use ($user) {
        $query->where('user_id', $user->id);
    })
    ->get();

    return response()->json([
        'message' => 'success',
        'data' =>  $cartItems
    ]);
    }

    public function addToCart(ShoppingCartItemRequest $request)
    {
    $user = auth()->user();
    $cart = $user->shoppingCart;
    $cartId = $cart->id;

    $validatedData = $request->validated();
    $productId = $validatedData['product_item_id'];

    $existingCartItem = ShoppingCartItem::where('cart_id', $cartId)
        ->where('product_item_id', $productId)
        ->first();

    if ($existingCartItem) {
        return response()->json([
            'message' => 'The item is already in the cart.',
        ]);
    }

    $shoppingCartItem = new ShoppingCartItem([
        'cart_id' => $cartId,
        'product_item_id' => $productId,
        'selectedToCheckout' => false, 
    ]);
    $shoppingCartItem->save();

    return response()->json([
        'message' => 'success',
    ]);
    }
    public function deleteCartItem($cartItemId)
    {
    $cartItem = ShoppingCartItem::find($cartItemId);

    if (!$cartItem) {
        return response()->json([
            'message' => 'Cart item not found.',
        ], 404);
    }

    $cartItem->delete();

    return response()->json([
        'message' => 'success',
    ]);
    }

    public function selectCartItemForCheckout($cartItemId)
    {
    $cartItem = ShoppingCartItem::find($cartItemId);

    if (!$cartItem) {
        return response()->json([
            'message' => 'Cart item not found.',
        ], 404);
    }

    $cartItem->selectedToCheckout = true;
    $cartItem->save();

    return response()->json([
        'message' => 'success',
    ]);
    }

    public function unselectCartItemForCheckout($cartItemId)
    {
    $cartItem = ShoppingCartItem::find($cartItemId);

    if (!$cartItem) {
        return response()->json([
            'message' => 'Cart item not found.',
        ], 404);
    }

    $cartItem->selectedToCheckout = false;
    $cartItem->save();

    return response()->json([
        'message' => 'success',
    ]);
    }
    
    
}
        
