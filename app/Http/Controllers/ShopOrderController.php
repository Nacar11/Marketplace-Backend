<?php

namespace App\Http\Controllers;
use App\Models\ShopOrder;
use App\Models\ShippingMethod;
use Illuminate\Http\Request;
use App\Http\Requests\ShopOrderRequest;

class ShopOrderController extends Controller
{
    public function __invoke()
    {
        $shopOrders = ShopOrder::all();

        return response()->json($shopOrders);
    }

    public function store(ShopOrderRequest $request) 
{
    $userId = auth()->user()->id;
    $validatedData = $request->validated();
    $validatedData['user_id'] = $userId;

    $firstSM = ShippingMethod::first();
    $validatedData['shipping_method_id'] = $firstSM ? $firstSM->id : null;
    $validatedData['order_date'] = now()->format('Y-m-d');
    $validatedData['order_status_id'] = 1;

    // Generate a unique SKU
    $sku = uniqid();
    $validatedData['SKU'] = $sku;

    $shopOrder = ShopOrder::create($validatedData);

    return response()->json([
        'message' => 'Success',
        'shopOrder' => $shopOrder
    ], 201);
}

    public function getShopOrderByID(Request $request)
{
    $userId = auth()->user()->id;
    $shopOrders = ShopOrder::with('orderLines')
        ->where('user_id', $userId)
        ->get();

    return response()->json($shopOrders);
}

}
