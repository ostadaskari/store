<?php

namespace App\Models\Warehouse;

use App\Models\ProductSeo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Product extends Model
{
    protected $connection = 'warehouse';
    protected $table = 'products';
    public $timestamps = false;

    protected $fillable = ['name', 'category_id'];

    static public function getSingle($id)
    {
        return  self::find($id);
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function lots()
    {
        return $this->hasMany(ProductLot::class, 'product_id');
    }

    public function getAvailableQtyAttribute()
    {
        return $this->lots()->where('lock', 0)->sum('qty_available');
    }
    public function images()
    {
        return $this->hasMany(Image::class, 'product_id');
    }

    public function coverImage()
    {
        return $this->hasOne(Image::class, 'product_id')->where('is_cover', 1);
    }

    public function seo()
    {
        return $this->hasOne(ProductSeo::class, 'product_part_number', 'part_number');
    }
    public function price()
    {
        return $this->hasOne(\App\Models\ProductPrice::class, 'product_part_number', 'part_number');
    }
    public function getDisplayPriceTomanAttribute()
    {
        if ($this->price && $this->price->sell_price_toman) {
            return $this->price->sell_price_toman;
        }

        $settings = \App\Models\PriceSetting::first();
        if ($this->price && $settings) {
            $mult = 1 + (($settings->profit_percent + $settings->extra_percent) / 100);
            if ($this->price->usd_price) {
                return $this->price->usd_price * $mult * $settings->dollar_rate;
            }
            if ($this->price->toman_price) {
                return round($this->price->toman_price * $mult, 2);
            }
        }
        return null;
    }


    public function featureValues()
    {
        return $this->hasMany(ProductFeatureValue::class, 'product_id');
    }
    public function features()
    {
        return $this->hasManyThrough(
            \App\Models\Warehouse\Feature::class,
            \App\Models\Warehouse\ProductFeatureValue::class,
            'product_id',   // FK on product_feature_values
            'id',           // PK on features
            'id',           // PK on products
            'feature_id'    // FK on product_feature_values
        );
    }

    public function pdfs()
    {
        return $this->hasMany(Pdf::class, 'product_id');
    }

    public function relatedProducts()
    {
        return $this->hasMany(Product::class, 'category_id', 'category_id')
            ->where('id', '!=', $this->id)
            ->limit(4)
            ->inRandomOrder();
    }






}
