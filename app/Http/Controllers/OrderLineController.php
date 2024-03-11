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

    public function getAllOrderLines()
    {
    $orderLines = OrderLine::with([
        'user',
        // 'shippingAddress',
        // 'orderStatus',
        // 'productItem.productImages',
        'productItem.product'
    ])->get();

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
    $validatedData['order_date'] = now()->format('Y-m-d');    
    $validatedData['order_status_id'] = 1;

    // create orderLine
    try {
        //buyer
        $orderLine = OrderLine::create($validatedData);
        $orderLine->load('user', 'paymentMethod', 'shippingAddress.country', 'shippingMethod', 'productItem.user', 'productItem.product');        
        $user = auth()->user();
        // $user->notify(new OrderPlacedNotification($orderLine));
        
        //clear shopping cart
        // $shoppingCartController = new ShoppingCartController();
        // $shoppingCartController->deleteAllShoppingCartItems($user->id);    
        // $shoppingCart = ShoppingCart::where('user_id', $userId)->first();
        // $shoppingCart->items()->delete();

        //seller
        // $productOwner = $orderLine->productItem->user;
        // $productOwner->notify(new OrderReceivedNotification($orderLine));
        
        return response()->json(['message' => 'success'], 201);
    } catch (\Exception $e) {
        return response()->json(['message' => $e], 500); 
    }
    }   

    public function getOrderLinesFromProductListings()
    {
    $userId = auth()->user()->id;

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

 
}





