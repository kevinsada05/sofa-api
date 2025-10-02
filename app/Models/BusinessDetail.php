<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessDetail extends Model
{
    protected $fillable = [
        'listing_id', 'business_name', 'established_year', 'employees', 'on_main_street', 'parking',
        'floors', 'bathrooms', 'kitchen', 'outdoor_area', 'storage_room',
        'alarm_system', 'fire_safety', 'handicap_accessible',
        'equipment_included', 'inventory_included', 'license_included', 'franchise'
    ];

    protected $casts = [
        'established_year' => 'integer',
        'employees' => 'integer',
        'on_main_street' => 'boolean',
        'parking' => 'boolean',
        'floors' => 'integer',
        'bathrooms' => 'integer',
        'kitchen' => 'boolean',
        'outdoor_area' => 'boolean',
        'storage_room' => 'boolean',
        'alarm_system' => 'boolean',
        'fire_safety' => 'boolean',
        'handicap_accessible' => 'boolean',
        'equipment_included' => 'boolean',
        'inventory_included' => 'boolean',
        'license_included' => 'boolean',
        'franchise' => 'boolean',
    ];

    public function listing()
    {
        return $this->belongsTo(Listing::class);
    }

    public function businessTypes()
    {
        return $this->belongsToMany(BusinessType::class, 'business_business_type');
    }
}
