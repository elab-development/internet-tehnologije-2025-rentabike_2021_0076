<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bike extends Model
{
    protected $fillable = [
        'name',
        'brand',
        'type',
        'price_per_hour',
        'description',
        'image',
        'is_available',
    ];
}
