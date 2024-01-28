<?php

namespace App\Http\Controllers;

use App\Http\Resources\FavoriteResource;
use App\Models\Favorite;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function __invoke()
    {
        $favorites = Favorite::with('user', 'productItem.product.productCategory', 'productItem.productImages', 'productItem.productConfigurations.variationOption.variation')
            ->get();

        return FavoriteResource::collection($favorites);
    }

    public function getFavoritesByUser()
    {

        $userId = auth()->user()->id;
        $favorites = Favorite::with('productItem.product.productCategory', 'productItem.productImages', 'productItem.productConfigurations.variationOption.variation')
            ->where('user_id', $userId)
            ->get();

             return response()->json([
        'message' => 'success',
        'data' =>  $favorites,
    ]);
      
    }

    public function addToFavorites(Request $request)
    {
        $userId = auth()->user()->id;
        $productId = $request->input('product_item_id');

       
        $existingFavorite = Favorite::where('user_id', $userId)
            ->where('product_item_id', $productId)
            ->first();

        if ($existingFavorite) {
            return response()->json([
                'message' => 'Product item is already a favorite for the user.',
            ], 422);
        }

        
        $favorite = new Favorite([
            'user_id' => $userId,
            'product_item_id' => $productId,
        ]);

        $favorite->save();

        return response()->json([
            'message' => 'success',
            'data' => new FavoriteResource($favorite),
        ]);
    }

    public function removeFromFavorites(Request $request)
{
    $userId = auth()->user()->id;
    $productId = $request->input('product_item_id');

    $favorite = Favorite::where('user_id', $userId)
        ->where('product_item_id', $productId)
        ->first();

    if (!$favorite) {
        return response()->json([
            'message' => 'Product item is not found in the user\'s favorites.',
        ], 404);
    }

    $favorite->delete();

    return response()->json([
        'message' => 'success',
    ]);
}
}