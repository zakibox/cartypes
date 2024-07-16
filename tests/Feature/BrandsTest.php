<?php

namespace Tests\Feature;
use App\Models\Brand;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
class BrandsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_retreives_all_brands()
    {
        $brands = Brand::factory(3)->create();

        $response = $this->getJson('/api/brands');

        $response->assertStatus(200)
                 ->assertJsonCount(3, 'data');
    }

    /** @test */
    public function it_creates_new_brand()
    {
        $response = $this->postJson('/api/brands', [
            'name' => 'Test Brand',
            // because i worked with spatie media library a file should be uploaded got it ?
            'img' => fake()->image('testjpg'),
        ]);

        $response->assertStatus(201)
                 ->assertJson([
                     'message' => 'Brand created successfully',
                     'brand' => [
                         'name' => 'Test Brand',
                         'img' => 'testjpg'
                     ]
                 ]);

        $this->assertDatabaseHas('brands', [
            'name' => 'Test Brand',
            'img' => 'testjpg'
        ]);
    }

    /** @test */
    //wach nziid exception tests ??
    public function it_shows_validation_error_when_creating_brand_without_name()
    {
        $response = $this->postJson('/api/brands', []);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors('name');
    }

    /** @test */
    public function it_can_show_a_single_brand()
    {
        $brand = Brand::factory()->create();

        $response = $this->getJson("/api/brands/{$brand->id}");

        $response->assertStatus(200)
                 ->assertJson([
                    'data' => [
                        'id' => $brand->id,
                        "name"=> $brand->name
                    ]
                 ]);
    }

    /** @test */
    public function it_returns_404_if_brand_not_found()
    {
        $response = $this->getJson('/api/brands/999');

        $response->assertStatus(404);
    }

    /** @test */
    public function it_can_update_a_brand()
    {
        $brand = Brand::factory()->create();

        $response = $this->putJson("/api/brands/{$brand->id}", [
            'name' => 'Updated Brand Name',
        ]);

        $response->assertStatus(200)
                 ->assertJson([
                     'message' => 'Brand updated successfully',
                     'brand' => [
                         'name' => 'Updated Brand Name',
                     ]
                 ]);

        $this->assertDatabaseHas('brands', [
            'id' => $brand->id,
            'name' => 'Updated Brand Name',
        ]);
    }

    /** @test */
    public function it_shows_validation_error_when_updating_brand_without_name()
    {
        $brand = Brand::factory()->create();

        $response = $this->putJson("/api/brands/{$brand->id}", []);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors('name');
    }

    /** @test */
    public function it_can_delete_a_brand()
    {
        $brand = Brand::factory()->create();

        $response = $this->deleteJson("/api/brands/{$brand->id}");

        $response->assertStatus(200)
                 ->assertJson([
                     'message' => 'Brand deleted successfully',
                 ]);

        $this->assertDatabaseMissing('brands', [
            'id' => $brand->id,
        ]);
    }
}
