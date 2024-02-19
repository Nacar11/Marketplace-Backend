<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'contact_number', 
        'unit_number',
        'address_line_1',
        'address_line_2',
        'city_id', 
        'region_id', 
        'postal_code',
        'country_id',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function userAddresses()
    {
        return $this->hasMany(UserAddress::class);
    }
}