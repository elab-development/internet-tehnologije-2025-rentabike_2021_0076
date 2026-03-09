<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
        protected $fillable = [
        'user_id',
        'Equipment_id',
        'start_date',
        'end_date',
        'total_price',
        'status',
    ];
}
