<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderLine extends Model
{
    protected $table = 'order_line'; // Set the table name

    protected $fillable = [
        'shop_order_id',
        'product_item_id',
        'qty',
        'price',
    ];

    public function shopOrder()
    {
        return $this->belongsTo(ShopOrder::class, 'shop_order_id');
    }

    public function productItem()
    {
        return $this->belongsTo(ProductItem::class, 'product_item_id');
    }
}

