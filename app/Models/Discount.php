<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $table = 'discounts';
    protected $fillable = [
        'name','code','type','value','min_order_amount',
        'start_at','expire_at','status','is_deleted',
        'max_uses','uses_count','per_user_limit',
        'applicable_products','applicable_categories',
        'stackable','description','created_by'
    ];
    protected $casts = [
        'start_at' => 'datetime',
        'expire_at' => 'datetime',
        'applicable_products' => 'array',
        'applicable_categories' => 'array',
        'status' => 'boolean',
        'is_deleted' => 'boolean',
        'stackable' => 'boolean',
    ];
    public function isActive(): bool
    {
        if ($this->is_deleted || !$this->status) return false;
        $now = now();
        if ($this->start_at && $now->lt($this->start_at)) return false;
        if ($this->expire_at && $now->gt($this->expire_at)) return false;
        if ($this->max_uses && $this->uses_count >= $this->max_uses) return false;
        return true;
    }

}
