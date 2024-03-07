<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderLineRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
    return [
        'user_id' => 'required|integer|exists:users,id',
        'product_item_id' => 'required|integer|exists:product_items,id',
        'price' => 'required|numeric',
        'payment_method_id' => 'required|integer|exists:user_payment_methods,id',
        'shipping_address_id' => 'required|integer|exists:addresses,id',
    ];

    }
}


