<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductItemController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\VariationController;
use App\Http\Controllers\VariationOptionController;
use App\Http\Controllers\ProductConfigurationController;
use App\Http\Controllers\ShoppingCartItemController;
use App\Http\Controllers\ShoppingCartController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\PaymentTypeController;
use App\Http\Controllers\OrderLineController;
use App\Http\Controllers\ShippingMethodController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\CityController;

Route::group(['middleware' => ['auth:sanctum']], function () {
    //INITIALIZE USER DATA
    Route::get('getUserData', [UserController::class, 'getUserData']);
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::get('getUserGender', [UserController::class, 'getUserGender']);


    //PRODUCT ITEMS AND FAVORITE PRODUCT ITEMS
    Route::get('productItems', ProductItemController::class);
    Route::get('getProductItemsByProductType/{id}', [ProductItemController::class, 'getProductItemsByProductType']);
    Route::get('productItem/{id}', [ProductItemController::class, 'getProductItem']);
    Route::get('getProductItemsByUser', [ProductItemController::class, 'getProductItemsByUser']);
    Route::delete('deleteListedItem/{id}', [ProductItemController::class, 'deleteListedItem']);
    Route::post('/addListingAndConfiguration', [ProductItemController::class, 'addListingAndConfiguration']);
    Route::get('getFavoritesByUser', [FavoriteController::class, 'getFavoritesByUser']);
    Route::post('addToFavorites', [FavoriteController::class, 'addToFavorites']);
    Route::delete('removeFromFavorites', [FavoriteController::class, 'removeFromFavorites']);

    //PRODUCT TYPES AND CATEGORIES
    Route::get('getOrganizedProductCategories', ProductCategoryController::class);
    Route::get('productCategories', [ProductCategoryController::class, 'getProductCategories']);
    Route::get('getProductTypesByCategory/{id}', [ProductCategoryController::class, 'getProductTypesByCategory']);
    Route::get('getProductTypes', [ProductController::class, 'getProductTypes']);
    Route::get('product', ProductController::class);



    //REGIONS, COUNTRIES AND CITIES
    Route::get('getRegionsByCountryId/{id}', [RegionController::class, 'getRegionsByCountryId']);
    Route::get('getCitiesByRegionId/{id}', [CityController::class, 'getCitiesByRegionId']);
 

    //VARIATIONS
    Route::get('getVariationsByProductCategory/{id}', [ProductCategoryController::class, 'getVariationsByProductCategory']);
    Route::get('productConfiguration', [ProductConfigurationController::class, 'getAll']);
    Route::post('productConfiguration', [ProductConfigurationController::class, 'add']);

   
 
    //SHOPPING CART
    Route::get('getShoppingCartItemsByUser', ShoppingCartItemController::class);
    Route::post('addToCart', [ShoppingCartItemController::class, 'addToCart']);
    Route::delete('deleteCartItem/{cartItemId}', [ShoppingCartItemController::class, 'deleteCartItem']);
    Route::put('selectForCheckout/{id}/',  [ShoppingCartItemController::class, 'selectCartItemForCheckout']);
    Route::put('unSelectForCheckout/{id}',  [ShoppingCartItemController::class, 'unselectCartItemForCheckout']);

    //ADDRESS
    Route::get('/countries', CountryController::class);
    Route::post('/addAddress', [AddressController::class, 'store']);
    Route::get('/getAddresses', [AddressController::class, 'getAddresses']);
    Route::get('/userHasAddress', [AddressController::class, 'userHasAddress']);
    Route::delete('/deleteAddress/{id}', [AddressController::class, 'deleteAddress']);
    Route::post('/setDefaultAddress/{id}', [AddressController::class, 'setDefaultAddress']);
    Route::get('/getDefaultAddress', [AddressController::class, 'getDefaultAddress']);

    //PAYMENTS AND ORDERS
    Route::get('/getOrderLinesByUser', [OrderLineController::class,'getOrderLinesByUser']);
    Route::get('/getAllOrderLines', OrderLineController::class);
    Route::get('/getPaymentTypes', PaymentTypeController::class);
    Route::get('/getShippingMethods', ShippingMethodController::class);
    Route::post('/cancelOrderLine/{orderLineId}', [OrderLineController::class, 'cancelOrderLine']);
    

});

Route::get('test',function(){
    return 'success';
});

//USER LOGIN / FRONTPAGE APIS
Route::post('changePass', [AuthController::class, 'changePassword']);
Route::post('/login', [AuthController::class, 'login']);

//SOCIAL LOGINS
Route::post('google/callback', [AuthController::class, 'googleRedirect']);
Route::post('facebook/callback', [AuthController::class, 'facebookRedirect']);

//SIGN UP PROCESS
Route::post('/checkEmail', [AuthController::class, 'checkEmail']);
Route::post('/getUserByEmail', [AuthController::class, 'getUserByEmail']);
Route::post('/checkUsername', [AuthController::class, 'checkUsername']);
Route::post('/register', [AuthController::class, 'register']);
//GOOGLE.DEVELOPERS
Route::post('/getEmailVerificationCode', [AuthController::class, 'getEmailVerificationCode']);
//VONAGE SMS
Route::post('/SMSVerificationCode', [AuthController::class, 'SMSVerificationCode']);

//SHORTCUTS
Route::post('variation/', [VariationController::class, 'store']);
Route::post('variation-option/', [VariationOptionController::class, 'store']);
Route::post('storeMultipleVariationOptions/', [VariationOptionController::class, 'storeMultiple']);

//WEBHOOKS FROM PAYMONGO
Route::post('/checkoutPaymentSuccess', [OrderLineController::class,'checkoutPaymentSuccess']);

