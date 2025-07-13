<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WeaponListing extends Model
{
    protected $fillable = [
        'weapon_id',
        'country_id',
        'marketType',
        'is_available',
        'price',
        'quantity',
    ];

    protected $casts = [
        'is_available' => 'boolean',
        'price' => 'decimal:2',
    ];

    public function weapon()
    {
        return $this->belongsTo(Weapon::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    
}
