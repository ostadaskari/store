<?php

namespace App\Models\Warehouse;

use Illuminate\Database\Eloquent\Model;

class ProductFeatureValue extends Model
{
    protected $connection = 'warehouse';
    protected $table = 'product_feature_values';
    public $timestamps = false;

    protected $casts = [
        'value' => 'array',
    ];

    public function feature()
    {
        return $this->belongsTo(Feature::class, 'feature_id');
    }
}

