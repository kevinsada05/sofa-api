<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApartmentDetail extends Model
{
    protected $fillable = [
        'listing_id',
        'elevator',
        'year_build_id',
        'condition_id',
        'furnishing_id',
        'orientation_id',
        'heating_id',
        'bedrooms',
        'bathrooms',
        'floor',
        'balcony',
        'veranda',
        'garden',
        'apartment_type_id',
    ];

    protected $casts = [
        'elevator' => 'boolean',
        'bedrooms' => 'integer',
        'bathrooms' => 'integer',
        'floor' => 'integer',
        'balcony' => 'boolean',
        'veranda' => 'boolean',
        'garden' => 'boolean',
    ];

// Relationships
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

    public function apartmentType()
    {
        return $this->belongsTo(ApartmentType::class);
    }
}
