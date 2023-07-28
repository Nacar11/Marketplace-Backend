<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class UserRequest extends FormRequest
{

    protected function prepareForValidation()
{
    if ($this->has('password')) {
        $this->merge([
            'password' => Hash::make($this->input('password')),
        ]);
    }
}
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'username' => ['required', 'string', 'unique:users,username,' . $this->id . ',id'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'contact_number' => ['string', "max:255"],
            'date_of_birth' => ['required', 'date_format:Y-m-d'],
            'email' => ['required', 'email', "unique:users,email,$this->id,id"],
            'gender' => ['required', 'string', 'max: 10'],
            'password' => ['min:10'],
            //reg ex (?=.*[A-Z]) = one uppercase
            //(?=.*\d)) = one digit
            // (?=.*[$@$!%*?&]) = one special
        ];
    }

    public function wantsJson()
    {
        return true;
    }

    public function messages()
    {
        return [
            'email.email' => ' Email must be a valid email address.',
            'email.unique' => ' Email has already been taken.',
        ];
    }
}
