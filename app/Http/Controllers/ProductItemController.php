<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductItemResource;
use App\Http\Requests\ProductItemRequest;
use App\Models\ProductItem;
use App\Models\ProductImage;
use Carbon\Carbon;
use App\Models\Product;
use Illuminate\Http\Request;


class ProductItemController extends Controller
{
    public function __invoke()
    {
        $productItems = ProductItem::with('product', 'productImages', 'variationOptions.variation')->get();    
        return $productItems;
    }

    public function getProductItemsByProductType($productId)
{
    $productItems = ProductItem::with('product.productCategory', 'productImages', 'variationOptions.variation')
        ->where('product_id', $productId)
        ->get();
    
    return $productItems;
    
}

    public function store(ProductItemRequest $request)
{
    $user = auth()->user();
    $userId = $user->id;
    $sku = uniqid();
    $productItem = ProductItem::create(array_merge($request->validated(), [
        'user_id' => $userId,
        'SKU' => $sku,
    ]));

    // Handle product images
    if ($request->hasFile('product_images')) {
        $uploadedImages = $request->file('product_images');
        $imagePaths = [];
        $i = 1;
        foreach ($uploadedImages as $image) {
            $imagePath = $image->store('uploads/products'); // Store the uploaded image
            $imagePaths[] = asset($imagePath); // Store the image URL
        }

        $productItem->productImages()->createMany([
            ['product_image' => $imagePaths],
        ]);
    }
    $productItem->load('product', 'productImages', 'variationOptions.variation');

    return $productItem;
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

    public function getProductItem($id)
    {
        $productItem = ProductItem::find($id);
    
        if (!$productItem) {
            return response()->json(['message' => 'ProductItem not found'], 404);
        }
    
        $productItem->load('user', 'product', 'product.productCategory', 'productImages', 'variationOptions.variation');
        return response()->json(['data' => $productItem], 200);
    }
}
