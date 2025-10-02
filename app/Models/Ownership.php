<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ownership extends Model
{
    protected $fillable = ['name', 'code'];

    public function listings()
    {
        return $this->hasMany(Listing::class);
    }

}
