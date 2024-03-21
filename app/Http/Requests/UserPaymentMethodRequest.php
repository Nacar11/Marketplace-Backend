<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserPaymentMethodRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'payment_type_id' => 'required|integer',
            'provider' => 'required|string',
            'account_number' => 'required|string',
            'expiry_date' => 'required|date',
            'is_default' => 'boolean',
        ];
    }
}
