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
        'special_profit_percent',
        'original_price',
        'final_usd',
        'sell_price_toman'
    ];

}
