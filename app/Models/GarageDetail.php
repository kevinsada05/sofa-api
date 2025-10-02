<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GarageDetail extends Model
{
    protected $fillable = [
        'listing_id', 'capacity', 'electric_door', 'security_camera',
        'lighting', 'water', 'electricity', 'floor'
    ];

    protected $casts = [
        'capacity' => 'integer',
        'electric_door' => 'boolean',
        'security_camera' => 'boolean',
        'lighting' => 'boolean',
        'water' => 'boolean',
        'electricity' => 'boolean',
    ];

    public function listing() {
        return $this->belongsTo(Listing::class);
    }
}
