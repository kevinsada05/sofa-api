<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SoilQuality extends Model
{
    protected $fillable = ['name', 'code'];

    public function agriculturalLandDetails()
    {
        return $this->hasMany(AgriculturalLandDetail::class);
    }
}
