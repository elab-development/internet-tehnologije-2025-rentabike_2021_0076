<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Equipment;

class EquipmentSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('bikes')->delete();

        Equipment::create([
            'name' => 'Gradski bicikl',
            'brand' => 'Capriolo',
            'type' => 'bicycle',
            'price_per_hour' => 350,
            'description' => 'Bicikl za gradsku vožnju',
            'is_available' => true
        ]);

        Equipment::create([
            'name' => 'Planinski bicikl',
            'brand' => 'Trek',
            'type' => 'bicycle',
            'price_per_hour' => 500,
            'description' => 'Bicikl za planinske staze',
            'is_available' => true
        ]);

        Equipment::create([
            'name' => 'Električni bicikl Pro',
            'brand' => 'Cube',
            'type' => 'electric_bike',
            'price_per_hour' => 650,
            'description' => 'Električni bicikl sa asistencijom',
            'is_available' => true
        ]);

        Equipment::create([
            'name' => 'Električni bicikl City',
            'brand' => 'Giant',
            'type' => 'electric_bike',
            'price_per_hour' => 800,
            'description' => 'Električni bicikl za grad',
            'is_available' => true
        ]);

        Equipment::create([
            'name' => 'Trotinet Urban',
            'brand' => 'Xiaomi',
            'type' => 'scooter',
            'price_per_hour' => 300,
            'description' => 'Klasičan trotinet',
            'is_available' => true
        ]);

        Equipment::create([
            'name' => 'Trotinet Street',
            'brand' => 'Razor',
            'type' => 'scooter',
            'price_per_hour' => 400,
            'description' => 'Trotinet za gradsku vožnju',
            'is_available' => true
        ]);

        Equipment::create([
            'name' => 'Električni trotinet Max',
            'brand' => 'Segway',
            'type' => 'electric_scooter',
            'price_per_hour' => 600,
            'description' => 'Električni trotinet velike snage',
            'is_available' => true
        ]);

        Equipment::create([
            'name' => 'Električni trotinet Lite',
            'brand' => 'Xiaomi',
            'type' => 'electric_scooter',
            'price_per_hour' => 500,
            'description' => 'Lak električni trotinet',
            'is_available' => true
        ]);

        Equipment::create([
            'name' => 'Roleri rekreativni',
            'brand' => 'Rollerblade',
            'type' => 'roller',
            'price_per_hour' => 300,
            'description' => 'Roleri za rekreaciju',
            'is_available' => true
        ]);

        Equipment::create([
            'name' => 'Roleri profesionalni',
            'brand' => 'K2',
            'type' => 'roller',
            'price_per_hour' => 400,
            'description' => 'Profesionalni roleri',
            'is_available' => true
        ]);
    }
}