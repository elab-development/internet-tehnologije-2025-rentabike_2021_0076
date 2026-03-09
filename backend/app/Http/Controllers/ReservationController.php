<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;

class ReservationController extends Controller
{
    public function index()
{
    $reservations = Reservation::all();
    return $reservations;
}
public function store(Request $request)
{
    $reservation = Reservation::create([
        'user_id' => $request->user_id,
        'bike_id' => $request->bike_id,
        'start_date' => $request->start_date,
        'end_date' => $request->end_date,
        'total_price' => $request->total_price,
        'status' => 'pending'
    ]);

    return $reservation;
}
}
