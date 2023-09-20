<?php

namespace App\Http\Controllers;
use App\Models\Orderline;
use App\Http\Requests\OrderLineRequest;
use Illuminate\Http\Request;
use App\Models\ShippingMethod;


class OrderLineController extends Controller
{
    public function __invoke()
    {
    $userId = auth()->user()->id;
    $orderLines = OrderLine::with([
        'user',
        'shippingAddress',
        'orderStatus',
        'productItem.productImages',
        'productItem.product'
    ])->where('user_id', $userId)->get();
    return response()->json($orderLines);
    }

    public function getSingleOrderLine($id)
    {
        $orderLine = OrderLine::with([
            'user',
            'paymentMethod',
            'shippingAddress',
            'orderStatus',
            'shippingMethod',
            'productItem.productImages',
            'productItem.product'
        ])->find($id);

        if (!$orderLine) {
            return response()->json(['message' => 'Order line not found'], 404);
        }
        return response()->json($orderLine);
    }

    public function store(OrderLineRequest $request)
    {
    $validatedData = $request->validated();
    
    $sku = uniqid();
    $userId = auth()->user()->id;
    $validatedData['SKU'] = $sku;
    $validatedData['user_id'] = $userId;
    $firstSM = ShippingMethod::first();
    $validatedData['shipping_method_id'] = $firstSM ? $firstSM->id : null;
    $validatedData['order_date'] = now()->format('Y-m-d H:i:s');    $validatedData['order_status_id'] = 1;

    // Attempt to create the OrderLine
    try {
        $orderLine = OrderLine::create($validatedData);
        // Return a success response
        return response()->json(['message' => 'success'], 201);
    } catch (\Exception $e) {
        // Handle any exceptions that may occur during creation
        return response()->json(['message' => 'error'], 500); // You can customize the error response as needed
    }
    }   

    public function getOrderLinesFromProductListings()
    {
    $userId = auth()->user()->id;

    // Retrieve the order lines associated with product items of the user
    $orderLines = OrderLine::whereIn('product_item_id', function ($query) use ($userId) {
        $query->select('id')
            ->from('product_items')
            ->where('user_id', $userId);
    })->with([
        'user',
        'paymentMethod',
        'shippingAddress',
        'orderStatus',
        'shippingMethod',
        'productItem.productImages',
        'productItem.product'
    ])->get();

    return response()->json($orderLines);
    }








}
