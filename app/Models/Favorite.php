<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'product_item_id'];

 
    public function user()
    {
        return $this->belongsTo(User::class);
    }

   
    public function productItem()
    {
        return $this->belongsTo(ProductItem::class);
    }
}