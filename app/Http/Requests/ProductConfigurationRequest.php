<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductConfigurationRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'product_item_id' => 'required|exists:product_items,id',
            'variation_option_id' => 'required|exists:variation_options,id',
        ];
    }
}
