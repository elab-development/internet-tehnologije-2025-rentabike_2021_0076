<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Equipment;
use App\Enums\EquipmentType;
use Illuminate\Validation\Rule;
use OpenApi\Attributes as OA;

class EquipmentController extends Controller
{
    #[OA\Get(
    path: '/api/equipment',
    summary: 'Prikaz dostupne opreme',
    tags: ['Equipment'],
    responses: [
        new OA\Response(
            response: 200,
            description: 'Lista dostupne opreme',
            content: new OA\JsonContent(
                type: 'array',
                items: new OA\Items(
                    type: 'object',
                    properties: [
                        new OA\Property(property: 'id', type: 'integer', example: 1),
                        new OA\Property(property: 'name', type: 'string', example: 'Mountain Bike'),
                        new OA\Property(property: 'brand', type: 'string', example: 'Trek'),
                        new OA\Property(property: 'type', type: 'string', example: 'bike'),
                        new OA\Property(property: 'price_per_hour', type: 'number', format: 'float', example: 15),
                        new OA\Property(property: 'is_available', type: 'boolean', example: true)
                    ]
                )
            )
        )
    ]
)]
    public function index()
{
    $equipments = Equipment::where('is_available', true)->get();

    return $equipments;
}

 public function store(Request $request)
{
    $request->validate([
    'name' => 'required|string|max:255',
    'brand' => 'required|string|max:255',
    'type' => ['required', Rule::enum(EquipmentType::class)],
    'price_per_hour' => 'required|numeric|min:0'
]);

    $equipment = Equipment::create([
        'name' => $request->name,
        'brand' => $request->brand,
        'type' => $request->type,
        'price_per_hour' => $request->price_per_hour,
        'description' => $request->description,
        'image' => $request->image,
        'is_available' => true
    ]);

    return $equipment;
}
public function show($id)
{
    $equipment = Equipment::find($id);
    return $equipment;
}
public function update(Request $request, $id)
{
    $equipment = Equipment::find($id);

    $equipment->update([
        'name' => $request->name,
        'brand' => $request->brand,
        'type' => $request->type,
        'price_per_hour' => $request->price_per_hour,
        'description' => $request->description,
        'image' => $request->image,
    ]);

    return $equipment;
}
public function destroy($id)
{
    $equipment = Equipment::find($id);
    $equipment->delete();

    return "Equipment deleted";
}
}
