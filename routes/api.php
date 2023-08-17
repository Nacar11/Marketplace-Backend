<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
// use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductItemController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\VariationController;
use App\Http\Controllers\VariationOptionController;
use App\Http\Controllers\ProductConfigurationController;
use App\Http\Controllers\ShoppingCartItemController;
use App\Http\Controllers\ShoppingCartController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::group(['middleware' => ['auth:sanctum']], function () {
    // Route::get('user', UserController::class);
    // Route::put('user/{id}', [UserController::class, 'update']);
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::get('product-item', ProductItemController::class);
    Route::get('product-item/{product}', [ProductItemController::class, 'show']);
    // Route::put('product-item/{product}', [ProductItemController::class, 'update']);
    // Route::delete('/product-item/{product}', [ProductItemController::class, 'destroy']);
    Route::post('product-item', [ProductItemController::class, 'store']);

    Route::get('product', ProductController::class);
    Route::get('getVariantsByProductTypes/{id}', [ProductController::class, 'getVariantsByProductTypes']);
    // Route::get('product-category', ProductCategoryController::class);
    // Route::get('product-category/{id}', [ProductCategoryController::class, 'show']);
    // Route::get('/logout', [AuthController::class, 'logout']);
    Route::get('variationOptions/{id}', [VariationController::class, 'getVariationOptions']);
    Route::get('variation', VariationController::class);
    Route::get('variation/{variation}', [VariationController::class, 'show']);
    Route::post('variation/', [VariationController::class, 'store']);
    // Route::put('variation/{variation}', [VariationController::class, 'update']);
    // Route::delete('variation/{variation}', [VariationController::class, 'destroy']);
    Route::get('product-configuration', [ProductConfigurationController::class, 'getAll']);
    Route::post('product-configuration', [ProductConfigurationController::class, 'add']);

    Route::get('variation-option', VariationOptionController::class);
    Route::get('variation-option/{id}', [VariationOptionController::class, 'show']);
    Route::post('variation-option/', [VariationOptionController::class, 'store']);
    Route::put('variation-option/{id}', [VariationOptionController::class, 'update']);
    Route::delete('variation-option/{id}', [VariationOptionController::class, 'destroy']);

    Route::get('getCartItems', ShoppingCartItemController::class);
    Route::get('getCartItemByID/{id}', [ShoppingCartItemController::class, 'getCartItemByID']);
    Route::post('addToCart', [ShoppingCartItemController::class, 'addToCart']);
    Route::get('getShoppingCartByUser/{id}', [AuthController::class, 'getShoppingCartByUser']);



});


Route::get('/users', AuthController::class);

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('test',function(){
    return 'Success';
});
Route::get('product-category', ProductCategoryController::class);
Route::get('product-category/{id}', [ProductCategoryController::class, 'show']);
Route::get('getProductItemByCategory/{id}', [ProductCategoryController::class, 'getProductItemsByCategory']);

Route::get('product-item', ProductItemController::class);