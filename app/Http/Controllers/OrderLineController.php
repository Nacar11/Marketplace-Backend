<?php

namespace App\Http\Controllers;
use App\Models\Orderline;
use App\Http\Requests\OrderLineRequest;
use Illuminate\Http\Request;

class OrderLineController extends Controller
{
    public function __invoke()
    {
        $orderLines = OrderLine::all();

        return response()->json($orderLines);
    }

    public function store(OrderLineRequest $request)
    {
        $validatedData = $request->validated();
        
        // Generate a unique SKU
        $sku = uniqid();
        $validatedData['SKU'] = $sku;
    
        $orderLine = OrderLine::create($validatedData);
    
        return response()->json($orderLine, 201);
    }

    public function getOrderLinesFromProductListings()
{
    $userId = auth()->user()->id;

    // Retrieve the order lines associated with product items of the user
    $orderLines = OrderLine::whereIn('product_item_id', function ($query) use ($userId) {
        $query->select('id')
            ->from('product_items')
            ->where('user_id', $userId);
    })->with('productItem')->get();

    return response()->json($orderLines);
}


}
