<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SystemError extends Model
{
    protected $fillable = [
        'message', 'trace', 'file', 'line', 'url', 'method', 'user_id'
    ];
}
