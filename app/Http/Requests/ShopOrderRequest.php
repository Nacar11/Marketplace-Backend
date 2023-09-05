<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShopOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'order_date' => 'required|date',
            'payment_method_id' => 'required|integer',
            'shipping_address_id' => 'required|integer',
            'shipping_method' => 'required|string',
            'order_total' => 'required|numeric',
            'order_status' => 'required|string',
        ];
    }
}
