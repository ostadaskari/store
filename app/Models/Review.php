<?php

namespace App\Models;

use App\Models\Warehouse\Product;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $connection = 'mysql';
    protected $fillable = ['user_id', 'product_id', 'order_id', 'comment', 'status','admin_reply'];

    public function product()
    {
        // Laravel handles the cross-connection query automatically
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
