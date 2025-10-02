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

    // app/Models/User.php
    public function isIndividual()
    {
        return $this->user_type_id == 1;
    }

    public function isBusiness()
    {
        return $this->user_type_id == 2;
    }

    public function isAgency()
    {
        return $this->user_type_id == 3;
    }

    public function isAdmin(): bool
    {
        return $this->is_admin == 1;
    }

// App\Models\User.php
    public function deviceTokens()
    {
        return $this->hasMany(DeviceToken::class);
    }

}
