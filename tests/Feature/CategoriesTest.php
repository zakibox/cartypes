<?php

namespace Tests\Feature;

use App\Models\Categorie;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoriesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_retrieves_all_categories()
    {
        Categorie::factory(3)->create();

        $response = $this->getJson('/api/categories');

        $response->assertStatus(200)
                 ->assertJsonCount(3, 'data');
                
    }

    /** @test */
    public function it_creates_new_categorie()
    {
        $response = $this->postJson('/api/categories', [
            'name' => 'Test categorie',
        ]);

        $response->assertStatus(201)
                 ->assertJson([
                     'message' => 'Category created successfully',
                 ]);

        $this->assertDatabaseHas('categories', [
            'name' => 'Test categorie',
        ]);
    }

    /** @test */
    public function it_shows_validation_error_when_creating_categorie_without_name()
    {
        $response = $this->postJson('/api/categories', []);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors('name');
    }

    /** @test */
    public function it_can_show_a_single_categorie()
    {
        $categorie = Categorie::factory()->create();

        $response = $this->getJson("/api/categories/{$categorie->id}");

        $response->assertStatus(200);
             
    }

    /** @test */
    public function it_returns_404_if_categorie_not_found()
    {
        $response = $this->getJson('/api/categories/999');

        $response->assertStatus(404);
    }

    /** @test */
    public function it_can_update_a_categorie()
    {
        $categorie = Categorie::factory()->create();

        $response = $this->putJson("/api/categories/{$categorie->id}", [
            'name' => 'Updated categorie Name',
        ]);

        $response->assertStatus(200)
                 ->assertJson([
                     'message' => 'Category updated successfully',
                 ]);

        $this->assertDatabaseHas('categories', [
            'name' => 'Updated categorie Name',
        ]);
    }

    /** @test */
    public function it_shows_validation_error_when_updating_categorie_without_name()
    {
        $categorie = Categorie::factory()->create();

        $response = $this->putJson("/api/categories/{$categorie->id}", []);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors('name');
    }

    /** @test */
    public function it_can_delete_a_categorie()
    {
        $categorie = Categorie::factory()->create();

        $response = $this->deleteJson("/api/categories/{$categorie->id}");

        $response->assertStatus(200)
                 ->assertJson([
                     'message' => 'Category deleted successfully',
                 ]);

        $this->assertDatabaseMissing('categories', [
            'id' => $categorie->id,
        ]);
    }
}
