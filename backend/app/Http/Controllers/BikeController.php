<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bike;

class BikeController extends Controller
{
    public function index()
{
    $bikes = Bike::all();
        return $bikes;
}

 public function store(Request $request)
{
    $bike = Bike::create([
        'name' => $request->name,
        'brand' => $request->brand,
        'type' => $request->type,
        'price_per_hour' => $request->price_per_hour,
        'description' => $request->description,
        'image' => $request->image,
        'is_available' => true
    ]);

    return $bike;
}
public function show($id)
{
    $bike = Bike::find($id);
    return $bike;
}
public function update(Request $request, $id)
{
    $bike = Bike::find($id);

    $bike->update([
        'name' => $request->name,
        'brand' => $request->brand,
        'type' => $request->type,
        'price_per_hour' => $request->price_per_hour,
        'description' => $request->description,
        'image' => $request->image,
    ]);

    return $bike;
}
public function destroy($id)
{
    $bike = Bike::find($id);
    $bike->delete();

    return "Bike deleted";
}
}
