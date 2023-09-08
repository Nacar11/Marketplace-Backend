<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopOrder extends Model
{
    use HasFactory;

    protected $table = 'shop_order';

    protected $fillable = [
        'user_id',
        'order_date',
        'SKU',
        'payment_method_id',
        'shipping_address_id',
        'shipping_method_id',
        'order_total',
        'order_status_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function paymentMethod()
    {
        return $this->belongsTo(UserPaymentMethod::class, 'payment_method_id');
    }

    public function shippingAddress()
    {
        return $this->belongsTo(Address::class, 'shipping_address_id');
    }

    public function orderStatus()
    {
        return $this->belongsTo(OrderStatus::class, 'order_status_id');
    }

    public function shippingMethod()
    {
        return $this->belongsTo(ShippingMethod::class, 'shipping_method_id');
    }

    public function orderLines()
    {
        return $this->hasMany(OrderLine::class, 'shop_order_id');
    }
}