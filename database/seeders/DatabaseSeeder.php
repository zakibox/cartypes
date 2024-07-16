<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Categorie;
use App\Models\Fuel;
use App\Models\Models;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call(BrandSeeder::class);
        $this->call(CategorieSeeder::class);
        $this->call(FuelSeeder::class);
        $this->call(ModelsSeeder::class);
    }
}
