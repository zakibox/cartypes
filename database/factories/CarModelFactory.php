<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Models>
 */
class CarModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'brand_id' => \App\Models\Brand::factory(),
            'fuel_id' => \App\Models\Fuel::factory(),
            'category_id' => \App\Models\Categorie::factory(),
        ];
    }
}
