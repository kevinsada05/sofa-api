<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OfficeDetail extends Model
{
    protected $fillable = [
        'listing_id', 'year_build_id', 'condition_id', 'furnishing_id', 'orientation_id', 'heating_id',
        'bathrooms', 'parking', 'rooms', 'conference_hall', 'floor', 'meeting_room',
        'open_space', 'reception', 'elevator', 'internet', 'air_conditioning',
        'kitchenette', 'security_system'
    ];

    protected $casts = [
        'bathrooms' => 'integer',
        'parking' => 'boolean',
        'rooms' => 'integer',
        'conference_hall' => 'boolean',
        'floor' => 'integer',
        'meeting_room' => 'boolean',
        'open_space' => 'boolean',
        'reception' => 'boolean',
        'elevator' => 'boolean',
        'internet' => 'boolean',
        'air_conditioning' => 'boolean',
        'kitchenette' => 'boolean',
        'security_system' => 'boolean',
    ];

    public function listing()
    {
        return $this->belongsTo(Listing::class);
    }

    public function yearBuild()
    {
        return $this->belongsTo(YearBuild::class);
    }

    public function condition()
    {
        return $this->belongsTo(Condition::class);
    }

    public function furnishing()
    {
        return $this->belongsTo(Furnishing::class);
    }

    public function orientation()
    {
        return $this->belongsTo(Orientation::class);
    }

    public function heating()
    {
        return $this->belongsTo(Heating::class);
    }
}
