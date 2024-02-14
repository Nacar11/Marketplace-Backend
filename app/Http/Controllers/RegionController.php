<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Region;

class RegionController extends Controller
{
    public function getRegionsByCountryId($countryId)
    {
        $regions = Region::where('country_id', $countryId)->get();
        return response()->json(['message' => 'success', 'data' => $regions]);
    }

    public function __invoke()
    {
        $regions = Region::all();
        return response()->json(['message' => 'success', 'data' => $regions]);
    }
}
