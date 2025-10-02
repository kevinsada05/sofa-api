<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessType extends Model
{
    protected $fillable = ['name', 'code'];

    public function businessDetails()
    {
        return $this->belongsToMany(BusinessDetail::class, 'business_business_type');
    }
}
