<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
      protected $fillable = [
        'name',
        'city',
        'address'
    ];

    public function Equipments()
    {
        return $this->hasMany(Equipment::class);
    }
}
