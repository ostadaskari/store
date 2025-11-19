<?php

namespace App\Models\Warehouse;

use Illuminate\Database\Eloquent\Model;

class ProductLot extends Model
{
    protected $connection = 'warehouse';
    protected $table = 'product_lots';
    public $timestamps = false;

    protected $fillable = ['product_id', 'qty_available', 'lock'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
