<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WarehouseDetail extends Model
{
    protected $fillable = [
        'listing_id', 'year_build_id', 'condition_id', 'floor_height_m', 'parking',
        'loading_dock', 'water', 'security', 'office_space'
    ];

    protected $casts = [
        'floor_height_m' => 'integer',
        'parking' => 'boolean',
        'loading_dock' => 'boolean',
        'water' => 'boolean',
        'security' => 'boolean',
        'office_space' => 'boolean',
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

}
