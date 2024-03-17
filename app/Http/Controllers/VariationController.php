<?php

namespace App\Http\Controllers;
use App\Models\Variation;
use App\Models\VariationOption;
use Illuminate\Http\Request;
use App\Http\Requests\VariationRequest;
use App\Http\Resources\VariationResource;

class VariationController extends Controller
{
    public function store(VariationRequest $request)
    {
        $validatedData = $request->validated();

        $variation = Variation::create([
            'name' => $validatedData['name'],
            'category_id' => $validatedData['category_id'],
        ]);

        return response()->json([
            'message' => 'success',
            'data' => $variation,
        ], 201);
    }
 
}
