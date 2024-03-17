<?php

namespace App\Http\Controllers;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductItem;


class ProductCategoryController extends Controller
{

    
public function getProductCategories()
{
        $categories = ProductCategory::all();

          return response()->json(['message' => 'success', 'data' => $categories], 200);

}

public function __invoke()
{
    $categories = ProductCategory::query()->get();

    $organizedCategories = [];

    foreach ($categories as $category) {
        if (!$category->category_id) {
            $organizedCategories[$category->id] = [
                'id' => $category->id,
                'category_id' => $category->category_id,
                'category_name' => $category->category_name,
                'product_image' => $category->product_image, // Include product_image
                'children' => [],
            ];
        } else {
            if (!isset($organizedCategories[$category->category_id])) {
                $organizedCategories[$category->category_id] = [
                    'id' => $category->category_id,
                    'children' => [],
                ];
            }
            $organizedCategories[$category->category_id]['children'][] = [
                'id' => $category->id,
                'category_id' => $category->category_id,
                'category_name' => $category->category_name,
                'product_image' => $category->product_image, // Include product_image
            ];
        }
    }

    $result = array_values($organizedCategories);
    
    return response()->json(['message' => 'success', 'data' => $result], 200);
}

    public function getProductTypesByCategory($id)
{
    $productCategory = ProductCategory::find($id);
    if (!$productCategory) {
        return response()->json(['message' => 'No Product Types in this Category'], 404);
    }

    $product_types = $productCategory->products;
    return response()->json([
        'message' => 'success',
        'data' => $product_types,
    ], 200);
}
}
