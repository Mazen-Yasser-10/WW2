<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WeaponListing extends Model
{
    use HasFactory;
    
    protected static function booted()
    {
        static::saving(function ($item) {
            if ($item->quantity < 1) {
                $item->is_available = false;
            }else {
                $item->is_available = true;
            }    
        });
    }

    public function weapon()
    {
        return $this->belongsTo(Weapon::class);
    }

    // public function weaponType()
    // {
    //     return $this->belongsToThrough(weaponType::class, Weapon::class);
    // }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
