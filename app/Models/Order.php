<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'cart_id',
        'weapon_listing_id',
        'quantity',
        'total_price'
    ];

    protected static function booted()
    {
        static::saving(function ($order) {
            if (!$order->relationLoaded('weaponListing')) {
                $order->load('weaponListing');
            }

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
