<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
    protected $fillable = ['name', 'price'];

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
