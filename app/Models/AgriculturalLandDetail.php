<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgriculturalLandDetail extends Model
{
    protected $fillable = [
        'listing_id', 'water_access', 'electricity_access', 'road_access',
        'land_type_id', 'irrigation_system', 'soil_quality_id', 'fenced', 'terrain_type_id'
    ];

    protected $casts = [
        'water_access' => 'boolean',
        'electricity_access' => 'boolean',
        'road_access' => 'boolean',
        'irrigation_system' => 'boolean',
        'fenced' => 'boolean',
    ];

    public function listing()
    {
        return $this->belongsTo(Listing::class);
    }

    public function landType()
    {
        return $this->belongsTo(LandType::class);
    }

    public function soilQuality()
    {
        return $this->belongsTo(SoilQuality::class);
    }

    public function terrainType()
    {
        return $this->belongsTo(TerrainType::class);
    }
}
