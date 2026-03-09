<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Equipment;

class EquipmentController extends Controller
{
    public function index()
{
    $Equipments = Equipment::all();
        return $Equipments;
}

 public function store(Request $request)
{
    $Equipment = Equipment::create([
        'name' => $request->name,
        'brand' => $request->brand,
        'type' => $request->type,
        'price_per_hour' => $request->price_per_hour,
        'description' => $request->description,
        'image' => $request->image,
        'is_available' => true
    ]);

    return $Equipment;
}
public function show($id)
{
    $Equipment = Equipment::find($id);
    return $Equipment;
}
public function update(Request $request, $id)
{
    $Equipment = Equipment::find($id);

    $Equipment->update([
        'name' => $request->name,
        'brand' => $request->brand,
        'type' => $request->type,
        'price_per_hour' => $request->price_per_hour,
        'description' => $request->description,
        'image' => $request->image,
    ]);

    return $Equipment;
}
public function destroy($id)
{
    $Equipment = Equipment::find($id);
    $Equipment->delete();

    return "Equipment deleted";
}
}
