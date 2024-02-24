<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShoppingCartItemRequest extends FormRequest
{
   
    public function authorize()
    {
        return true;
    }

    
    public function rules()
    {
        return [
            'product_item_id' => 'required|exists:product_items,id',
            'selectedToCheckout' => 'boolean',
        ];
    }
}
