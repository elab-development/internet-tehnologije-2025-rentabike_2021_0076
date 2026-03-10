<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Equipment;

class ReservationController extends Controller
{
    public function index(Request $request)
    {
        $reservations = Reservation::with('equipment')
            ->where('user_id', $request->user()->id)
            ->get();

        return response()->json($reservations, 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'bike_id' => 'required|exists:bikes,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'total_price' => 'required|numeric|min:0',
        ]);

        $bike = Equipment::findOrFail($validated['bike_id']);

        if (!$bike->is_available) {
            return response()->json([
                'message' => 'Equipment is not available.'
            ], 422);
        }

        $reservation = Reservation::create([
            'user_id' => $request->user()->id,
            'bike_id' => $validated['bike_id'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'total_price' => $validated['total_price'],
            'status' => 'pending'
        ]);

        $bike->is_available = false;
        $bike->save();

        return response()->json([
            'message' => 'Reservation created successfully.',
            'reservation' => $reservation
        ], 201);
    }

    public function destroy(Request $request, $id)
    {
        $reservation = Reservation::where('id', $id)
            ->where('user_id', $request->user()->id)
            ->first();

        if (!$reservation) {
            return response()->json([
                'message' => 'Reservation not found.'
            ], 404);
        }

        $bike = Equipment::find($reservation->bike_id);

        if ($bike) {
            $bike->is_available = true;
            $bike->save();
        }

        $reservation->delete();

        return response()->json([
            'message' => 'Reservation cancelled successfully.'
        ], 200);
    }
}