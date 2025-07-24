<?php

namespace Database\Seeders;

use App\Models\category;
use Illuminate\Database\Seeder;
use App\Models\Product;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();
        for ($i = 1; $i <= 10; $i++) {
        category::create([
            'name' => $faker->unique()->word(),
            'description' => $faker->sentence(),
            'imagepath' => '',
        ]);
    }



        $faker = Faker::create();
        for ($i = 1; $i <= 10; $i++) {
            Product::create([
                'name' => $faker->unique()->word(),
                'description' => $faker->sentence(),
                'imagepath' => $faker->imageUrl(640, 480, 'products', true),
                'quantity' => $faker->numberBetween(1, 100),
                'price' => $faker->randomFloat(2, 10, 1000),
                'category_id' => $faker->numberBetween(1, 10),
                
            ]);
        }
    }
}