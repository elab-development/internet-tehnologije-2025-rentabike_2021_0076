<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
protected $table = 'bikes';

    protected $fillable = [
        'name',
        'brand',
        'type',
        'price_per_hour',
        'description',
        'image',
        'is_available',
    ];
     public function location()
    {
        return $this->belongsTo(Location::class);
    }
    public function reservations()
{
    return $this->hasMany(Reservation::class, 'bike_id');
}
}
