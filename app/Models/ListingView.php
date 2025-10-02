<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ListingView extends Model
{
    protected $fillable = [
        'listing_id',
        'view_count',
        'real_view_count',
    ];

    protected $casts = [
        'view_count' => 'integer',
        'real_view_count' => 'integer',
    ];

    public function listing()
    {
        return $this->belongsTo(Listing::class);
    }
}
