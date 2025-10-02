<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class YearBuild extends Model
{
    protected $fillable = ['name', 'code'];

    public function apartmentDetails()
    {
        return $this->hasMany(ApartmentDetail::class);
    }

    public function villaDetails()
    {
        return $this->hasMany(VillaDetail::class);
    }

    public function sharedRentDetails()
    {
        return $this->hasMany(SharedRentDetail::class);
    }

    public function penthouseDetails()
    {
        return $this->hasMany(PenthouseDetail::class);
    }

    public function garsoniereDetails()
    {
        return $this->hasMany(GarsoniereDetail::class);
    }

    public function shopDetails()
    {
        return $this->hasMany(ShopDetail::class);
    }

    public function officeDetails()
    {
        return $this->hasMany(OfficeDetail::class);
    }

    public function warehouseDetails()
    {
        return $this->hasMany(WarehouseDetail::class);
    }
}
