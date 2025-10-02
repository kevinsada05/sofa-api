<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $fillable = [
        'listing_id',
        'session_key',
    ];

    public function listing()
    {
        return $this->belongsTo(Listing::class);
    }
}
