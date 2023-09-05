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
    
        $orderLine = OrderLine::create($request->validated());
    
        return response()->json($orderLine, 201);
    }}
