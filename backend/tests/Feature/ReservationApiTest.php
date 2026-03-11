<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Equipment;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReservationApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_reservation()
    {
        $user = User::factory()->create([
            'role' => 'customer',
        ]);

        $bike = Equipment::create([
            'name' => 'Test Bike',
            'brand' => 'Test Brand',
            'type' => 'bicycle',
            'price_per_hour' => 10,
            'is_available' => true
        ]);

        Sanctum::actingAs($user);

        $response = $this->postJson('/api/reservations', [
            'bike_id' => $bike->id,
            'start_date' => now(),
            'end_date' => now()->addHour(),
            'total_price' => 10
        ]);

        $response->assertStatus(201);
    }
}