<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductItem extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'SKU', 'qty_in_stock', 'product_image', 'price', 'user_id'];

    public function product()
{
    return $this->belongsTo(Product::class, 'product_id');
}
    // public function variationOptions()
    // {
    //     return $this->belongsToMany(VariationOption::class, 'product_configurations');
    // }
}
