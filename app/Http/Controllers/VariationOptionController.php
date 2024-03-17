<?php

namespace App\Http\Controllers;
use App\Models\VariationOption;
use Illuminate\Http\Request;
use App\Http\Requests\VariationOptionRequest;
use App\Http\Resources\VariationOptionResource;


class VariationOptionController extends Controller
{
    public function store(VariationOptionRequest $request)
    {
        $validatedData = $request->validated();

      
        $variationOption = VariationOption::create([
            'value' => $validatedData['value'],
            'variation_id' => $validatedData['variation_id'],
        ]);

        return response()->json([
            'message' => 'success',
            'data' => $variationOption,
        ], 201); 
    }

}
