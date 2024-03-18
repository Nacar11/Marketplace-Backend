<?php

namespace App\Http\Controllers;
use App\Models\OrderLine;
use App\Http\Requests\OrderLineRequest;
use Illuminate\Http\Request;
use App\Models\ShippingMethod;
use App\Models\Variation;
use App\Models\ShoppingCartItem;
use App\Models\ShoppingCart;
use Notifications;
use App\http\Controllers\ShoppingCartController;
use App\Notifications\welcomeEmailNotification;
use App\Notifications\OrderPlacedNotification;
use App\Notifications\OrderReceivedNotification;


class OrderLineController extends Controller
{
    

    public function __invoke()
    {
    $orderLines = OrderLine::with([
        'user',
        'productItem.product',
        'orderStatus'
    ])->get();
     return response()->json([
    'message' => 'success',
    'data' => $orderLines
    ]);
    }

    public function cancelOrderLine($orderLineId)
    {
    try {
        $orderLine = OrderLine::find($orderLineId);
        
        if (!$orderLine) {
            return response()->json(['message' => 'Order line not found'], 404);
        }
        
        $cancelledStatusId = 2;
        
        $orderLine->order_status_id = $cancelledStatusId;
        $orderLine->save();
        
        return response()->json(['message' => 'success'], 200);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
    }

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
            'data' => 'checkout session payment success'
            ], 200);
    }
 
    public function getOrderLinesByUser()
    {
   
    $userId = auth()->user()->id;

    $orderLines = OrderLine::with([
        'user' => function ($query) {
            $query->select('id', 'username', 'first_name', 'last_name', 'date_of_birth', 'email', 'contact_number', 'gender' );
        },
        'shippingAddress.city',
        'shippingAddress.region',
        'orderStatus',
        'shippingMethod',
        'productItem.productImages',
        'productItem.product',
        'productItem.user'
    ])->where('user_id', $userId)
      ->get();

    if ($orderLines->isEmpty()) {
        return response()->json(['message' => 'No order lines found for the user'], 404);
    }

    
    return response()->json([
    'message' => 'success',
    'data' => $orderLines
    ]);
    }

    public function deleteOrderLine($ID)
    {
    $result = OrderLine::where('id', '=', $ID)->delete();
    return response()->json([
        'status' => $result,
        'msg' => $result ? 'success' : 'fuck'
    ]);
    }


 
}





