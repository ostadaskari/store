<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'is_delete' => 'boolean',
        'is_payment' => 'boolean',
        'payment_data' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function shipping()
    {
        return $this->belongsTo(Shipping::class);
    }
    public function address()
    {
        return $this->belongsTo(UserAddress::class, 'user_address_id');
    }
}
