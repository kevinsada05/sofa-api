<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_type_id',
        'name',
        'email',
        'phone',
        'password',
        'fcm_token'
    ];

    protected $appends = [
        'is_individual',
        'is_business',
        'is_agency',
        'is_admin',
    ];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function profile()
    {
        return $this->hasOne(UserProfile::class);
    }

    public function listings()
    {
        return $this->hasMany(Listing::class);
    }

    public function type()
    {
        return $this->belongsTo(UserType::class, 'user_type_id');
    }

    public function getIsIndividualAttribute(): bool
    {
        return $this->user_type_id == 1;
    }

    public function getIsBusinessAttribute(): bool
    {
        return $this->user_type_id == 2;
    }

    public function getIsAgencyAttribute(): bool
    {
        return $this->user_type_id == 3;
    }

    public function getIsAdminAttribute(): bool
    {
        return $this->is_admin == 1;
    }

    public function deviceTokens()
    {
        return $this->hasMany(DeviceToken::class);
    }

}
