<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WeaponListing extends Model
{
    public function weapon()
    {
        return $this->belongsTo(Weapon::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
