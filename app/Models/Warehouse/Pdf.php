<?php

namespace App\Models\Warehouse;

use Illuminate\Database\Eloquent\Model;

class Pdf extends Model
{
    protected $connection = 'warehouse';
    protected $table = 'pdfs';
    public $timestamps = false;

    protected $fillable = [
        'product_id', 'file_name', 'file_path', 'file_size', 'file_extension', 'mime_type', 'uploaded_at'
    ];

    public function getUrlAttribute()
    {
        $path = ltrim($this->file_path, '/');

        $baseUrl = rtrim(env('MEGABAG_URL', 'http://localhost/megabag'), '/');

        return "{$baseUrl}/{$path}";
    }
}
