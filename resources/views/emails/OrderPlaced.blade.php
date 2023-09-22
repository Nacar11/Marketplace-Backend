@component('mail::message')
# Thank you for your Order!



Hi {{ $orderLine->user['first_name'] }}, <br>

We want to express our gratitude for your order with us. Your order details are as follows:<br>

Order #: {{ $orderLine['SKU'] }}<br>
Shipping Method: {{ $orderLine->shippingMethod['name'] }}<br>
Approved by(Product Item Owner): {{$orderLine->productItem->user['username']}}, 
{{$orderLine->productItem->user['first_name']}} {{$orderLine->productItem->user['last_name']}}<br><br>

Item Ordered: {{ $orderLine->productItem->product['name'] }}<br>
Price: Php {{ $orderLine->productItem['price'] }}<br>
Your order is now being processed and will be shipped to you shortly.<br><br>
Shipping Address:<br>
{{$orderLine->shippingAddress['address_line_1']}},<br>
{{$orderLine->shippingAddress['address_line_2']}},<br>
{{$orderLine->shippingAddress['city']}}, {{$orderLine->shippingAddress['postal_code']}} {{$orderLine->shippingAddress->country['name']}} <br><br>
If you have any questions or need further assistance, please don't hesitate to contact our customer support team.
Thank you for choosing us, and we look forward to serving you again soon!

Best regards,<br>
Marketplace Team


@endcomponent
