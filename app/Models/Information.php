<?php

namespace App\Models;

use App\Models\Warehouse\Product;
use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    protected $connection = 'mysql';

    protected $table = 'information';
    protected $fillable = [
        'product_part_number', 'title', 'description'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_part_number', 'part_number');
    }
}
