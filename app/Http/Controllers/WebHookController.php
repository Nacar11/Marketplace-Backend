<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Variation;

class WebHookController extends Controller
{
    public function checkoutPaymentSuccess(Request $request)
        {
       
             $lineItems= $request->input('data.attributes.data.attributes.line_items');

            foreach ($lineItems as $item) {
            $description = $item['description'];
            $variation = Variation::create([
                'name' => $description,
                'category_id' => 4,
                    ]);
                }
        
         return response()->json([
            'message' => 'success',
            'error' => 'webhook event'
            ], 200);
        }


}