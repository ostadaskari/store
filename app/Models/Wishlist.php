<?php

namespace App\Models;

use App\Models\Warehouse\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    // Explicitly set the connection to your main app DB
    protected $connection = 'mysql';

    protected $fillable = [
        'user_id',
        'product_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        // This will work because Eloquent will run a separate query
        // on the 'warehouse' connection to fetch the product details
        return $this->belongsTo(Product::class, 'product_id');
    }
}
