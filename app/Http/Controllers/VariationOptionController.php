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

      public function storeMultiple(Request $request)
    {
        $validatedData = $request->validate([
            'values' => 'required|array',
            'variation_id' => 'required|integer',
        ]);

        $variationOptions = [];
        foreach ($validatedData['values'] as $value) {
            $variationOption = VariationOption::create([
                'value' => $value,
                'variation_id' => $validatedData['variation_id'],
            ]);
            $variationOptions[] = $variationOption;
        }

        return response()->json([
            'message' => 'success',
        ], 201);
    }

}
