<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VillaDetail extends Model
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
        'floors',
        'balcony',
        'veranda',
        'garden',
        'parking',
        'pool',
        'basement',
    ];

    protected $casts = [
        'bedrooms' => 'integer',
        'bathrooms' => 'integer',
        'floors' => 'integer',
        'balcony' => 'boolean',
        'veranda' => 'boolean',
        'garden' => 'boolean',
        'parking' => 'boolean',
        'pool' => 'boolean',
        'basement' => 'boolean',
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
