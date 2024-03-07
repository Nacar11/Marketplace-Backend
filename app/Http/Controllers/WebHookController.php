<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Variation;
use App\Models\OrderLine;
use App\Models\ShippingMethod;
use App\Models\ShoppingCartItem;

class WebHookController extends Controller
{
    public function checkoutPaymentSuccess(Request $request)
    //WEBHOOK FUNCTION TO CREATE ORDER LINES WHEN CHECKOUT PAYMENT FROM PAYMONGO SUCCEEDED, LIVEMODE == FALSE
    //REFERENCE TO CHECKOUT SESSION RESOURCE JSON OBJECT
    //https://developers.paymongo.com/reference/checkout-session-resource
    //(THIS FUNCTION IS ONLY CALLED AS A WEBHOOK, CANNOT TEST IT THIS ON API CLIENT TOOLS)
        {
         $initialShippingMethod = ShippingMethod::first();
         $lineItems = $request->input('data.attributes.data.attributes.line_items');
         $metadata = $request->input('data.attributes.data.attributes.metadata');
         $ids = json_decode($metadata['cart_ids']);

            for ($i = 0; $i < count($lineItems); $i++) {
                $item = $lineItems[$i];
                $description = $item['description'];
                $amount = $item['amount'];

                $sku = uniqid();
               
                $shoppingCartItem  = ShoppingCartItem::find($ids[$i]);
                 $productItemId = $shoppingCartItem->product_item_id;

                OrderLine::create([
	                'product_item_id'=> $productItemId,
	                'price' => number_format($amount / 100, 2),
	                'payment_method_id'=> 1,
	                'shipping_address_id'=> $metadata['address_id'],
                    'user_id' => $metadata['user_id'],
                    'SKU' => $sku,
                    'shipping_method_id' => $initialShippingMethod ? $initialShippingMethod->id : null,
                    'order_date' =>now()->format('Y-m-d'),
                    'order_status_id' => 1
                    ]);
                    // here delete
                    $shoppingCartItem->delete();

            }
        return response()->json([
            'message' => 'success',
            'error' => 'webhook event'
            ], 200);
        }


}

