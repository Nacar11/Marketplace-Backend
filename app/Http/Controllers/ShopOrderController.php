<?php

namespace App\Http\Controllers;
use App\Models\ShopOrder;
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

        $shopOrder = ShopOrder::create($validatedData);
        return response()->json($shopOrder, 201);
    }
}
