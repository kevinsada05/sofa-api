<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TemporaryImage extends Model
{
    protected $fillable = [
        'user_id', 'is_primary', 'b2_key', 'original_name', 'size'
    ];
}
