<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SharedRentDetail extends Model
{
    protected $fillable = [
        'listing_id',
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
        'room_available',
        'total_roommates',
        'gender_preference',
        'student_only',
    ];

    protected $casts = [
        'bedrooms' => 'integer',
        'bathrooms' => 'integer',
        'floor' => 'integer',
        'balcony' => 'boolean',
        'veranda' => 'boolean',
        'garden' => 'boolean',
        'room_available' => 'boolean',
        'total_roommates' => 'integer',
        'student_only' => 'boolean',
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

    public function apartmentType()
    {
        return $this->belongsTo(ApartmentType::class);
    }
}
