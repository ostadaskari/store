<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Get the product from the Warehouse database.
     */
    public function product()
    {
        return $this->belongsTo(\App\Models\Warehouse\Product::class, 'product_id');
    }

    /**
     * Accessor for the discounted price of a single unit.
     */
    public function getDiscountedPriceAttribute()
    {
        return $this->price - ($this->price * ($this->discount_percent / 100));
    }

}
