<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPaymentMethod extends Model
{
    use HasFactory;

    protected $table = 'user_payment_methods'; // Specify the table name if it's not following Laravel's naming conventions

    protected $fillable = [
        'user_id',
        'payment_type_id',
        'provider',
        'account_number',
        'expiry_date',
        'is_default',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function paymentType()
    {
        return $this->belongsTo(PaymentType::class);
    }
}
