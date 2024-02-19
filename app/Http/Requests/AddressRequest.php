<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
{
   
    public function authorize()
    {
        return true;
    }

    
    public function rules()
    {
         return [
            'contact_number' => 'required|string',
            'unit_number' => 'nullable|string',
            'address_line_1' => 'required|string',
            'address_line_2' => 'nullable|string',
            'city_id' => 'required|exists:cities,id',
            'region_id' => 'required|exists:regions,id', 
            'postal_code' => 'required|string',
            'country_id' => 'required|exists:countries,id',
        ];
    }
}
