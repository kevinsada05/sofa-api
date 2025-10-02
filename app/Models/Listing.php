<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Listing extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'category_id',
        'city_id',
        'transaction_type_id',
        'rent_period_id',
        'ownership_id',
        'status_id',
        'description',
        'price',
        'negotiable',
        'address',
        'size_m2',
        'primary_image',
        'date_published',
        'expires_at',
    ];

    protected $casts = [
        'price' => 'integer',
        'negotiable' => 'boolean',
        'size_m2' => 'decimal:2',
        'date_published' => 'datetime',
        'expires_at' => 'datetime',
    ];

    protected $dates = ['deleted_at'];

    protected $appends = ['primary_image_url'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function images()
    {
        return $this->hasMany(ListingImage::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function views()
    {
        return $this->hasOne(ListingView::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function transactionType()
    {
        return $this->belongsTo(TransactionType::class);
    }

    public function rentPeriod()
    {
        return $this->belongsTo(RentPeriod::class);
    }

    public function ownership()
    {
        return $this->belongsTo(Ownership::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function apartmentDetail()
    {
        return $this->hasOne(ApartmentDetail::class);
    }

    public function villaDetail()
    {
        return $this->hasOne(VillaDetail::class);
    }

    public function sharedRentDetail()
    {
        return $this->hasOne(SharedRentDetail::class);
    }

    public function penthouseDetail()
    {
        return $this->hasOne(PenthouseDetail::class);
    }

    public function garsoniereDetail()
    {
        return $this->hasOne(GarsoniereDetail::class);
    }

    public function garageDetail()
    {
        return $this->hasOne(GarageDetail::class);
    }

    public function shopDetail()
    {
        return $this->hasOne(ShopDetail::class);
    }

    public function officeDetail()
    {
        return $this->hasOne(OfficeDetail::class);
    }

    public function warehouseDetail()
    {
        return $this->hasOne(WarehouseDetail::class);
    }

    public function agriculturalLandDetail()
    {
        return $this->hasOne(AgriculturalLandDetail::class);
    }

    public function plotDetail()
    {
        return $this->hasOne(PlotDetail::class);
    }

    public function businessDetail()
    {
        return $this->hasOne(BusinessDetail::class);
    }

    public function getTitleAttribute()
    {
        $title = '';

        // Category = Apartment with type
        if ($this->category?->code === 'apartment' && $this->details?->apartment_type_id) {
            $apartmentType = \App\Models\ApartmentType::find($this->details->apartment_type_id);

            if ($apartmentType) {
                // If type is Duplex, use only "Duplex"
                if (strtolower($apartmentType->code) === 'duplex' || strtolower($apartmentType->code) === 'studio') {
                    $title .= ucfirst($apartmentType->name);
                } else {
                    $title .= 'Apartament ' . $apartmentType->name;
                }
            } else {
                // fallback to generic category name if no type
                $title .= ucfirst(strtolower($this->category->name));
            }
        }
        // Other categories (villa, office, etc.)
        elseif ($this->category?->name) {
            $title .= ucfirst(strtolower($this->category->name));
        }

        // Transaction type
        if ($this->category?->code !== 'shared_rent' && $this->transactionType?->name) {
            $transaction = strtolower($this->transactionType->name);

            if ($transaction === 'qira') {
                $title .= ' me qira';

                // Add rent period if exists (mujor, ditor, etc.)
                if ($this->rentPeriod?->name) {
                    $title .= ' ' . strtolower($this->rentPeriod->name);
                }
            } elseif ($transaction === 'shitje') {
                $title .= ' në shitje';
            }
        }

        // City
        if ($this->city?->name) {
            $title .= ' në ' . $this->city->name;
        }

        return trim($title);
    }

    public function getFormattedDateAttribute()
    {
        return $this->date_published
            ->locale('sq')
            ->translatedFormat('d F Y');
    }

    public function getDetailsAttribute()
    {
        switch ($this->category?->code) {
            case 'apartment': return $this->apartmentDetail;
            case 'villa': return $this->villaDetail;
            case 'shared_rent': return $this->sharedRentDetail;
            case 'penthouse': return $this->penthouseDetail;
            case 'garsoniere': return $this->garsoniereDetail;
            case 'garage': return $this->garageDetail;
            case 'shop': return $this->shopDetail;
            case 'office': return $this->officeDetail;
            case 'warehouse': return $this->warehouseDetail;
            case 'agricultural_land': return $this->agriculturalLandDetail;
            case 'plot': return $this->plotDetail;
            case 'business': return $this->businessDetail;
            default: return null;
        }
    }

    public function getFormattedExpiryDateAttribute()
    {
        return $this->expires_at
            ? $this->expires_at->locale('sq')->translatedFormat('d F Y')
            : '-';
    }

    public function getPrimaryImageUrlAttribute(): ?string
    {
        $path = $this->primary_image;
        if (!$path) return null;

        if (file_exists(public_path($path))) {
            return asset($path);
        }

        // Otherwise assume it's in B2
        return Storage::disk('b2')->url($path);
    }

}
