<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class weaponType extends Model
{
    public function weapons()
    {
        return $this->hasMany(Weapon::class);
    }
}
