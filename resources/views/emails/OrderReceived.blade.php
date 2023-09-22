@component('mail::message')
# Your Product Item has been sold!


Hi {{ $orderLine->productItem->user['first_name'] }}, <br>

Congratulations! One of your Product Listings has been sold. Your order details are as follows:<br>

Order #: {{ $orderLine['SKU'] }}<br>
Shipping Method: {{ $orderLine->shippingMethod['name'] }}<br>
Sold to: {{$orderLine->user['username']}}, 
{{$orderLine->user['first_name']}} {{$orderLine->user['last_name']}}<br><br>

Item Sold: {{ $orderLine->productItem->product['name'] }}<br>
Price: Php {{ $orderLine->productItem['price'] }}<br>
The order is now being processed and it will be shipped to the buyer soon.<br><br>
Shipping Address:<br>
{{$orderLine->shippingAddress['address_line_1']}},<br>
{{$orderLine->shippingAddress['address_line_2']}},<br>
{{$orderLine->shippingAddress['city']}}, {{$orderLine->shippingAddress['postal_code']}} {{$orderLine->shippingAddress->country['name']}} <br><br>
If you have any questions or need further assistance, please don't hesitate to contact our customer support team.
Thank you for choosing us, and we look forward to serving you again soon!

Best regards,<br>
Marketplace Team






@endcomponent

