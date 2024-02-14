<?php

namespace App\Http\Controllers;
use App\Models\Country;

use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function __invoke()
    {
        $countries = Country::with('regions.cities')->get();
        return response()->json(['message' => 'success', 'data' => $countries]);
    }
}
