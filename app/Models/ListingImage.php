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
        if (! $path) return null;

        return 'https://cdn.sofa-app.site/file/sofa-al/' . ltrim($path, '/');
    }
}
