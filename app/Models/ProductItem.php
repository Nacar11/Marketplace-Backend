<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductImage;

class ProductItem extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'SKU', 'qty_in_stock', 'price', 'user_id'];

    public function product()
    {
    return $this->belongsTo(Product::class, 'product_id');
    }
    public function variationOptions()
    {
        return $this->belongsToMany(VariationOption::class, 'product_configurations');
    }

    public function productImages()
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'id');

    }
    public function productConfigurations()
    {
        return $this->hasMany(ProductConfiguration::class, 'product_item_id', 'id');
    }
}
