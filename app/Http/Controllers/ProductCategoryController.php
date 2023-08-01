<?php

namespace App\Http\Controllers;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

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
}
