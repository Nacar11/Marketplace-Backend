@component('mail::message')
# Thank you for your Order!

Hi{{ $user }}, <br>

Just to let you know, we have received your order #
{{ $orderLine['SKU']}}, and it is now being processed:

Shipping Method: {{ $shippingMethod['name']}}






@endcomponent
