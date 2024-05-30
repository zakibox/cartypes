<?php

namespace Tests\Feature;

use App\Models\CarModel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
class ModelsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_retreives_all_Models()
    {
        $Models = CarModel::factory(3)->create();

        $response = $this->getJson('/api/models');

        $response->assertStatus(200)
                 ->assertJsonCount(3, 'data');
    }

    /** @test */
    public function it_creates_new_Model()
    {
        $response = $this->postJson('/api/models', [
            'name' => 'Test CarModel',
            'fuel_id' => '1',
            'brand_id' => '1',
            'category_id' =>'1'
          
        ]);

        $response->assertStatus(201)
                 ->assertJson([
                     'message' => 'CarModel created successfully',
                     'CarModel' => [
                         'name' => 'Test CarModel',
                         'fuel_id' => '1',
                         'brand_id' => '1',
                         'category_id' =>'1'
                     ]
                 ]);

        $this->assertDatabaseHas('models', [
            'name' => 'Test CarModel',
            'fuel_id' => '1',
            'brand_id' => '1',
            'category_id' =>'1'
        ]);
    }

    /** @test */
    //wach nziid exception tests ??
    public function it_shows_validation_error_when_creating_model_without_name()
    {
        $response = $this->postJson('/api/models', []);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors('name');
    }

    /** @test */
    public function it_can_show_a_single_model()
    {
        $CarModel = CarModel::factory()->create();

        $response = $this->getJson("/api/models/{$CarModel->id}");

        $response->assertStatus(200)
                 ->assertJson([
                   
                 ]);
    }

    /** @test */
    public function it_returns_404_if_model_not_found()
    {
        $response = $this->getJson('/api/models/999');

        $response->assertStatus(404);
    }

    /** @test */
    public function it_can_update_a_model()
    {
        $CarModel = CarModel::factory()->create();

        $response = $this->putJson("/api/models/{$CarModel->id}", [
            'name' => 'Updated CarModel Name',
            'fuel_id' => '1',
            'brand_id' => '1',
            'category_id' =>'1'
        ]);

        $response->assertStatus(200)
                 ->assertJson([
                     'message' => 'CarModel updated successfully',
                 ]);

        $this->assertDatabaseHas('models', [
            'id' => $CarModel->id,
            'name' => 'Updated CarModel Name',
            'fuel_id' => '1',
            'brand_id' => '1',
            'category_id' =>'1'
        ]);
    }

    /** @test */
    public function it_shows_validation_error_when_updating_model_without_name()
    {
        $CarModel = CarModel::factory()->create();

        $response = $this->putJson("/api/models/{$CarModel->id}", []);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors('name');
    }

    /** @test */
    public function it_can_delete_a_model()
    {
        $CarModel = CarModel::factory()->create();

        $response = $this->deleteJson("/api/models/{$CarModel->id}");

        $response->assertStatus(200)
                 ->assertJson([
                     
                 ]);

        $this->assertDatabaseMissing('models', [
            'id' => $CarModel->id,
        ]);
    }
}

