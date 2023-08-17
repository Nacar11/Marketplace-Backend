<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\ProductItem;
use App\Models\ShoppingCart;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory;

    protected $fillable = [
        'username',
        'first_name',
        'last_name',
        'date_of_birth',
        'email',
        'contact_number',
        'gender',
        'password',

    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function productItems()
    {
        return $this->hasMany(ProductItem::class);
    }
    public function shoppingCart()
    {
        return $this->hasOne(ShoppingCart::class);
    }
}
