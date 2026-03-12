<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EquipmentApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_equipment_endpoint_returns_data()
    {
        $response = $this->get('/api/equipment');

        $response->assertStatus(200);
    }
}