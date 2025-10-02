<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TerrainType extends Model
{
    protected $fillable = ['name', 'code'];

    public function agriculturalLandDetails()
    {
        return $this->hasMany(AgriculturalLandDetail::class);
    }

    public function plotDetails()
    {
        return $this->hasMany(PlotDetail::class);
    }
}
