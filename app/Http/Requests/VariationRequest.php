<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VariationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => ['required', 'string'],
            'category_id' => ['required', 'integer', 'exists:product_categories,id'], // Ensure the category_id exists in the product_categories table.
        ];
    }

    public function wantsJson()
    {
        return true;
    }
}
