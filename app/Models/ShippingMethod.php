<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingMethod extends Modelsdfsadf
{
    use HasFactory;
    protected $table = 'shipping_method';

    protected $fillable = [
        'price',
        'name',
    ];

    protected $casts = [
        'price' => 'float',
    ];
}
