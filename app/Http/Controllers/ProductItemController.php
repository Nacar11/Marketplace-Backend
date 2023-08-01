<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductItemResource;
use App\Http\Requests\ProductItemRequest;
use App\Models\ProductItem;
use Carbon\Carbon;
use App\Models\Product;


class ProductItemController extends Controller
{
    public function __invoke()
    {
        $productItems = ProductItem::with('product')->get();

        return $productItems;
    }


    public function getProductName()
    {
    $products = Product::with('Product')->get();

    return $products;
    
    }

    public function store(ProductItemRequest $request)
    {

        $user = auth()->user();
        $userId = $user->id;
        $productItem = ProductItem::create(array_merge($request->validated(), [
            'user_id' => $userId,
        ]));

        return response()->json([
            'message' => 'Product item created successfully',
            'product_item' => $productItem,
        ], 201);
    }

    public function show($id)
    {
        $product_item = ProductItem::where('id', '=', $id)->first();
        return response()->json([
            'status' => "Success",
            'Body' => $product_item,
        ], 200);
    }

    public function update(ProductItemRequest $request, $id)
    {
        $productItem = ProductItem::find($id);
        $productItem->update($request->validated());
        return response()->json([
            'status' => "Success",
            'Body' => new ProductItemResource($productItem),

        ], 200);
    }

    public function destroy($id)
    {
    $result = ProductItem::where('id', '=', $id)->delete();
    return response()->json([
        'status' => $result,
        'msg' => $result ? 'success' : 'failed'
    ]);
    }
}
