<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ListingImage extends Model
{
    protected $fillable = [
        'listing_id',
        'image_path',
    ];

    protected $appends = ['url'];

    public function listing()
    {
        return $this->belongsTo(Listing::class);
    }

    public function getUrlAttribute(): ?string
    {
        $path = $this->image_path;
        if (!$path) {
            return null;
        }

        if (file_exists(public_path($path)) || file_exists(public_path('storage/'.$path))) {
            return asset($path);
        }

        return Storage::disk('b2')->url($path);
    }
}
