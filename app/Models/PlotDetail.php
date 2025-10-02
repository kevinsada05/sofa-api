<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlotDetail extends Model
{
    protected $fillable = [
        'listing_id', 'building_coefficient', 'construction_permit',
        'water', 'electricity', 'sewerage', 'road_access', 'terrain_type_id'
    ];

    protected $casts = [
        'building_coefficient' => 'decimal:2',
        'construction_permit' => 'boolean',
        'water' => 'boolean',
        'electricity' => 'boolean',
        'sewerage' => 'boolean',
        'road_access' => 'boolean',
    ];

    public function listing()
    {
        return $this->belongsTo(Listing::class);
    }

    public function terrainType()
    {
        return $this->belongsTo(TerrainType::class);
    }

}
