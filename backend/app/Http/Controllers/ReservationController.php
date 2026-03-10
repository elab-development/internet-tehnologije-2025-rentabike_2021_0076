<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Equipment;
use OpenApi\Attributes as OA;

class ReservationController extends Controller
{
    #[OA\Get(
    path: '/api/reservations',
    summary: 'Prikaz mojih rezervacija',
    tags: ['Reservations'],
    security: [['bearerAuth' => []]],
    responses: [
        new OA\Response(
            response: 200,
            description: 'Lista rezervacija ulogovanog korisnika',
            content: new OA\JsonContent(
                type: 'array',
                items: new OA\Items(
                    type: 'object',
                    properties: [
                        new OA\Property(property: 'id', type: 'integer', example: 1),
                        new OA\Property(property: 'user_id', type: 'integer', example: 3),
                        new OA\Property(property: 'bike_id', type: 'integer', example: 5),
                        new OA\Property(property: 'start_date', type: 'string', format: 'date', example: '2026-03-10'),
                        new OA\Property(property: 'end_date', type: 'string', format: 'date', example: '2026-03-12'),
                        new OA\Property(property: 'total_price', type: 'number', format: 'float', example: 40),
                        new OA\Property(property: 'status', type: 'string', example: 'pending')
                    ]
                )
            )
        ),
        new OA\Response(
            response: 401,
            description: 'Unauthenticated'
        )
    ]
)]
    public function index(Request $request)
    {
        $reservations = Reservation::with('equipment')
            ->where('user_id', $request->user()->id)
            ->get();

        return response()->json($reservations, 200);
    }
#[OA\Post(
    path: '/api/reservations',
    summary: 'Kreiranje rezervacije',
    tags: ['Reservations'],
    security: [['bearerAuth' => []]],
    requestBody: new OA\RequestBody(
        required: true,
        content: new OA\JsonContent(
            required: ['bike_id', 'start_date', 'end_date', 'total_price'],
            properties: [
                new OA\Property(property: 'bike_id', type: 'integer', example: 5),
                new OA\Property(property: 'start_date', type: 'string', format: 'date', example: '2026-03-10'),
                new OA\Property(property: 'end_date', type: 'string', format: 'date', example: '2026-03-12'),
                new OA\Property(property: 'total_price', type: 'number', format: 'float', example: 40)
            ]
        )
    ),
    responses: [
        new OA\Response(
            response: 201,
            description: 'Rezervacija uspešno kreirana',
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'message', type: 'string', example: 'Reservation created successfully.'),
                    new OA\Property(property: 'reservation', type: 'object')
                ]
            )
        ),
        new OA\Response(
            response: 401,
            description: 'Unauthenticated'
        ),
        new OA\Response(
            response: 422,
            description: 'Validation error or equipment unavailable'
        )
    ]
)]
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

    #[OA\Delete(
    path: '/api/reservations/{id}',
    summary: 'Otkazivanje rezervacije',
    tags: ['Reservations'],
    security: [['bearerAuth' => []]],
    parameters: [
        new OA\Parameter(
            name: 'id',
            description: 'ID rezervacije',
            in: 'path',
            required: true,
            schema: new OA\Schema(type: 'integer')
        )
    ],
    responses: [
        new OA\Response(
            response: 200,
            description: 'Rezervacija uspešno otkazana',
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'message', type: 'string', example: 'Reservation cancelled successfully.')
                ]
            )
        ),
        new OA\Response(
            response: 401,
            description: 'Unauthenticated'
        ),
        new OA\Response(
            response: 404,
            description: 'Reservation not found'
        )
    ]
)]
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