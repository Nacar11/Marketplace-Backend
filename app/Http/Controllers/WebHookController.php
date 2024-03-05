<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Variation;

class WebHookController extends Controller
{
    public function checkoutPaymentSuccess()
    {
  $variation = Variation::create([
            'name' => "Color",
            'category_id' => 4,
        ]);
        
         return response()->json([
            'message' => 'success',
            'error' => 'webhook event'
        ], 200);
    }


}