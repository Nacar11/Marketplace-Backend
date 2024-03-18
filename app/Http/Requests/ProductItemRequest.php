<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;


class ProductItemRequest extends FormRequest
{

   
    public function authorize(): bool
    {
        return true;
    }

  
    public function rules(): array
    {
        return [
            'product_id' => 'required|exists:products,id',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'variation_option_ids' => 'required|array', 
            'variation_option_ids.*' => 'exists:variation_options,id',
        ];
    }

    public function wantsJson()
    {
        return true;
    }

}
