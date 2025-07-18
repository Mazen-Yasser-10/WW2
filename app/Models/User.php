<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use \Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'country_id',
        'role',
        'cash',
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

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

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
            'cash' => 'decimal:2',
        ];
    }

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->take(2)
            ->map(fn ($word) => Str::substr($word, 0, 1))
            ->implode('');
    }

    /**
     * Get formatted cash balance
     */
    public function getFormattedCashAttribute($symbol): string
    {
        if($symbol === '£') {
            return $symbol . number_format($this->cash ?? 0, 2);
        } else {
            return number_format($this->cash ?? 0, 2) . $symbol;
        }
           
    }

    /**
     * Add cash to user balance
     */
    public function addCash(float $amount): bool
    {
        return $this->increment('cash', $amount);
    }
    /**
     * Check if user has sufficient cash
     */
    public function hasSufficientCash(float $amount): bool
    {
        return ($this->cash ?? 0) >= $amount;
    }

    /**
     * Get the user's cash attribute with default value
     */
    public function getCashAttribute($value): float
    {
        return (float) ($value ?? 0);
    }
}
