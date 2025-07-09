<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected static function booted()
    {
        static::saving(function ($order) {
            $order->total_price = $order->quantity * $order->weaponListing->price;
        });
    }
    
    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function weaponListing()
    {
        return $this->belongsTo(WeaponListing::class);
    }
}
