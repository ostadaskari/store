<?php

namespace App\Models\Warehouse;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $connection = 'warehouse'; // use warehouse DB
    protected $table = 'images';

    public $timestamps = false;

    protected $fillable = [
        'product_id',
        'file_name',
        'file_path',
        'file_size',
        'file_extension',
        'is_cover',
        'mime_type',
        'uploaded_at',

    ];

    public function product()
    {
        // Assuming your Product model is also in the Warehouse namespace
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function getUrlAttribute()
    {
        $path = ltrim($this->file_path, '/');

        $baseUrl = rtrim(env('MEGABAG_URL', 'http://localhost/megabag'), '/');

        return "{$baseUrl}/{$path}";
    }
}
