<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    protected $connection = 'mysql';

    protected $table = 'shippings';

    protected $fillable = [
        'name', 'slug', 'price', 'delivery_time',
        'min_weight', 'max_weight',
        'status', 'is_deleted', 'sort_order', 'created_by'
    ];

    protected $casts = [
        'status' => 'boolean',
        'is_deleted' => 'boolean',
        'price' => 'integer',
        'sort_order' => 'integer',
    ];

    // scope to only active (not deleted)
    public function scopeVisible($q)
    {
        return $q->where('is_deleted', false);
    }

    public function scopeActive($q)
    {
        return $q->where('status', true)->where('is_deleted', false);
    }
}
