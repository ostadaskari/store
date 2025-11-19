<?php

namespace App\Models\Warehouse;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    protected $connection = 'warehouse';
    protected $table = 'features';
    public $timestamps = false;

    protected $casts = [
        'metadata' => 'array',
    ];

    public function values()
    {
        return $this->hasMany(ProductFeatureValue::class, 'feature_id');
    }
}

