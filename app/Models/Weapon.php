<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; 

class Weapon extends Model
{
    use HasFactory;

    public function weaponType()
    {
        return $this->belongsTo(WeaponType::class);
    }

    public function weaponListings()
    {
        return $this->hasMany(WeaponListing::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
