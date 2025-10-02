<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApartmentType extends Model
{
    protected $fillable = ['name', 'code'];

    public function apartmentDetails()
    {
        return $this->hasMany(ApartmentDetail::class);
    }

    public function sharedRentDetails()
    {
        return $this->hasMany(SharedRentDetail::class);
    }

}
