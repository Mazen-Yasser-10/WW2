<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Weapon extends Model
{
    public function weaponType()
    {
        return $this->belongsTo(WeaponType::class);
    }

    public function weaponListings()
    {
        return $this->hasMany(WeaponListing::class);
    }
}
