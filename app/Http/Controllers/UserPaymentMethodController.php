<?php

namespace App\Http\Controllers;
use App\Models\UserPaymentMethod;
use App\Http\Requests\UserPaymentMethodRequest;


use Illuminate\Http\Request;

class UserPaymentMethodController extends Controller
{
    public function __invoke()
    {
        $userPaymentMethods = UserPaymentMethod::all();

        return response()->json($userPaymentMethods);
    }

}
