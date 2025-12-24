<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductPrice extends Model
{
    protected $connection = 'mysql';
    protected $table = 'product_prices';
    protected $fillable = [
        'product_part_number',
        'usd_price',
        'toman_price',
        'discount_percent',
        'final_usd',
        'sell_price_toman'
    ];

}
