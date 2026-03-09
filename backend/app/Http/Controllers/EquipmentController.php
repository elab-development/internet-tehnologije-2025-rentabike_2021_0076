<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Equipment;
use App\Enums\EquipmentType;
use Illuminate\Validation\Rule;

class EquipmentController extends Controller
{
    public function index()
{
    $equipments = Equipment::all();
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
