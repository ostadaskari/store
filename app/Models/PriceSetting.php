<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PriceSetting extends Model
{
    protected $connection = 'mysql';

    protected $table = 'price_settings';
    protected $fillable = ['dollar_rate', 'profit_percent', 'extra_percent'];

}
