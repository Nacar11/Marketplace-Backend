<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShippingMethod;
class ShippingMethodController extends Controller
{
    public function __invoke()
    {
        $shippingMethods = ShippingMethod::all();
         return response()->json([
        'message' => "success",
        'data' => $shippingMethods,
    ], 200);
    }

}
