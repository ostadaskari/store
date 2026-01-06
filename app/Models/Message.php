<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $table = 'messages';

    protected $fillable = [
        'name',
        'phone',
        'email',
        'message',
        'is_read'
    ];

}
