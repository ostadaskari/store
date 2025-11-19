<?php

namespace App\Models;

use App\Models\Warehouse\Product ;
use Illuminate\Database\Eloquent\Model;

class ProductSeo extends Model
{
    protected $connection = 'mysql';

    protected $table = 'product_seo';
    protected $fillable = [
        'product_part_number', 'meta_title', 'meta_description', 'meta_keywords'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_part_number', 'part_number');
    }
}
