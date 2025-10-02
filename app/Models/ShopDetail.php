<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShopDetail extends Model
{
    protected $fillable = [
        'listing_id', 'year_build_id', 'condition_id', 'furnishing_id', 'orientation_id', 'heating_id',
        'parking', 'warehouse', 'bathrooms', 'floor', 'main_street', 'corner_location',
        'double_facade', 'electricity', 'water_supply', 'ventilation', 'fire_safety', 'ceiling_height_m'
    ];

    protected $casts = [
        'parking' => 'boolean',
        'warehouse' => 'boolean',
        'bathrooms' => 'integer',
        'floor' => 'integer',
        'main_street' => 'boolean',
        'corner_location' => 'boolean',
        'double_facade' => 'boolean',
        'electricity' => 'boolean',
        'water_supply' => 'boolean',
        'ventilation' => 'boolean',
        'fire_safety' => 'boolean',
        'ceiling_height_m' => 'decimal:2',
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
