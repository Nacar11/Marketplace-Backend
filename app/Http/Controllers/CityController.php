<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;

class CityController extends Controller
{
     public function getCitiesByRegionId($regionId)
    {
         $cities = City::where('region_id', $regionId)->get();
        return response()->json(['message' => 'success', 'data' => $cities]);
    }

    public function __invoke()
    {
        $cities = City::all();
        return response()->json(['message' => 'success', 'data' => $cities]);
    }

}
