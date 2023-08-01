<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Carbon\Carbon;

class ProductController extends Controller
{
    public function __invoke()
    {
        return Product::query()->get();
    }

    
}
