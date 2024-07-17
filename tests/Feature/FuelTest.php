<?php

namespace Tests\Feature;

use App\Models\Fuel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
class FuelTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_retreives_all_Fuels()
    {
        $Fuels = Fuel::factory(3)->create();

        $response = $this->getJson('/api/fuels');

        $response->assertStatus(200)
                 ->assertJsonCount(3, 'data');
    }

    /** @test */
    public function it_creates_new_Fuel()
    {
        $response = $this->postJson('/api/fuels', [
            'fuel' => 'Test Fuel',
          
        ]);

        $response->assertStatus(201)
                 ->assertJson([
                     'message' => 'Fuel created successfully',
                 ]);

        $this->assertDatabaseHas('fuels', [
            'fuel' => 'Test Fuel',
        ]);
    }

    /** @test */
    //wach nziid exception tests ??
    public function it_shows_validation_error_when_creating_fuel_without_name()
    {
        $response = $this->postJson('/api/fuels', []);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors('fuel');
    }

    /** @test */
    public function it_can_show_a_single_fuel()
    {
        $Fuel = Fuel::factory()->create();

        $response = $this->getJson("/api/fuels/{$Fuel->id}");

        $response->assertStatus(200)
                 ->assertJson([
                    'data' => [
                        'id' => $Fuel->id,
                        "name"=> $Fuel->name
                    ]
                 ]);
    }

    /** @test */
    public function it_returns_404_if_fuel_not_found()
    {
        $response = $this->getJson('/api/fuels/999');

        $response->assertStatus(404);
    }

    /** @test */
    public function it_can_update_a_fuel()
    {
        $Fuel = Fuel::factory()->create();

        $response = $this->putJson("/api/Fuels/{$Fuel->id}", [
            'fuel' => 'Updated fuel Name',
        ]);

        $response->assertStatus(200)
                 ->assertJson([
                     'message' => 'Fuel updated successfully',
                 ]);

        $this->assertDatabaseHas('fuels', [
            'id' => $Fuel->id,
            'fuel' => 'Updated Fuel Name',
        ]);
    }

    /** @test */
    public function it_shows_validation_error_when_updating_fuel_without_name()
    {
        $Fuel = Fuel::factory()->create();

        $response = $this->putJson("/api/fuels/{$Fuel->id}", []);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors('fuel');
    }

    /** @test */
    public function it_can_delete_a_fuel()
    {
        $Fuel = Fuel::factory()->create();

        $response = $this->deleteJson("/api/fuels/{$Fuel->id}");

        $response->assertStatus(200)
                 ->assertJson([
                     'message' => 'Fuel deleted successfully',
                 ]);

        $this->assertDatabaseMissing('fuels', [
            'id' => $Fuel->id,
        ]);
    }
}

