<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductItemResource;
use App\Http\Requests\ProductItemRequest;
use App\Http\Requests\ImageFileRequest;
use App\Models\ProductItem;
use App\Models\ProductImage;
use Carbon\Carbon;
use App\Models\Product;
use Illuminate\Http\Request;


class ProductItemController extends Controller
{
    public function __invoke()
    {
        $productItems = ProductItem::with('product.productCategory', 'productImages', 'productConfigurations.variationOption.variation')->get();    

       return response()->json(['message' => 'success',
                          'data' => $productItems], 200);
    }

    public function getProductItemsByProductType($productId)
    {
    $productItems = ProductItem::with('product.productCategory', 'productImages', 'productConfigurations.variationOption.variation')
        ->where('product_id', $productId)
        ->get();
    
    return response()->json(['message' => 'success',
                          'data' => $productItems], 200);
    
    }

    public function getProductItemsByUser()
{
    $userId = auth()->user()->id;

    $productItems = ProductItem::with('product.productCategory', 'productImages', 'productConfigurations.variationOption.variation')
        ->where('user_id', $userId)
        ->get();
    
   
   return response()->json([
        'message' => "success",
        'data' => $productItems,
    ], 200);
}

    public function deleteListedItem($id)
    {
    $result = ProductItem::where('id', '=', $id)->delete();
    return response()->json([
        'message' => 'success',
    ]);
    }

    public function getProductItem($id)
    {
        $productItem = ProductItem::find($id);
    
        if (!$productItem) {
            return response()->json(['message' => 'ProductItem not found'], 404);
        }
    
        $productItem->load('user', 'product', 'product.productCategory', 'productImages', 'variationOptions.variation');
        return response()->json(['message' => 'success',
                                 'data' => $productItem], 200);
    }


public function addListing(ProductItemRequest $request)
{
    $user = auth()->user();
    $userId = $user->id;
    $sku = uniqid();
    $productItem = ProductItem::create(array_merge($request->validated(), [
        'user_id' => $userId,
        'SKU' => $sku,
    ]));
    

    foreach ($request->allFiles() as $fieldName => $file) {
        if ($file->isValid()) {
            $uniqueFileName = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $uniqueFileName);
            
            $finalImagePath = 'uploads/' . $uniqueFileName; 
            $productImage = new ProductImage([
                'product_id' => $productItem->id,
                'product_image' => asset($finalImagePath),
            ]);
            $productItem->productImages()->save($productImage);
        } else {
             return response()->json(['messages' => 'image not valid'], 200);
        }
    }

    return response()->json(['message' => 'success', 'data' => $productItem], 200);
}
}
