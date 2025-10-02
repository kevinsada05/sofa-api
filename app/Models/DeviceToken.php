<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeviceToken extends Model
{
    protected $fillable = ['token', 'user_id', 'installation_id', 'device'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
