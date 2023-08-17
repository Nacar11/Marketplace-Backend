<?php

namespace App\Http\Controllers;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductItem;


class ProductCategoryController extends Controller
{
    public function __invoke()
    {
        return ProductCategory::query()->get();
    }

    public function show($id)
    {
        // Find the ProductCategory by its ID
        $productCategory = ProductCategory::find($id);
        if (!$productCategory) {
            return response()->json(['message' => 'Product category not found'], 404);
        }

        // Retrieve the variations using the variations relationship
        $variations = $productCategory->variations;

        // Return the product category with its variations in the response
        return response()->json([
            'variations' => $variations,
        ], 200);
    }

    public function getProductItemsByCategory($id)
    {
        $productCategory = ProductCategory::find($id);

        if (!$productCategory) {
            return response()->json(['message' => 'Product category not found'], 404);
        }

        $productItems = Product::where('category_id', $productCategory->id)
            ->with(['productItems', 'productItems.variationOptions', 'productItems.productImages', 'productItems.product'])            ->get()
            ->flatMap(function ($product) {
                return $product->productItems;
            });

        return $productItems;
    }
}
