<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;

class ReservationController extends Controller
{
   public function index(Request $request)
    {
        $reservations = Reservation::where('user_id', $request->user()->id)->get();

        return response()->json($reservations, 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'bike_id' => 'required|exists:equipment,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'total_price' => 'required|numeric|min:0',
        ]);

        $reservation = Reservation::create([
            'user_id' => $request->user()->id,
            'bike_id' => $validated['bike_id'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'total_price' => $validated['total_price'],
            'status' => 'pending'
        ]);

        return response()->json([
            'message' => 'Reservation created successfully.',
            'reservation' => $reservation
        ], 201);
    }
}
