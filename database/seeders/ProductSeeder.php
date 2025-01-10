<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {

        $categories = Category::all();

        foreach ($categories as $category) {
            Product::create([
                'category_id' => $category->id,
                'brand_id' => rand(1, 4),
                'name' => fake()->words(3, true),
                'slug' => fake()->slug(),
                'description' => fake()->paragraph(),
                'price' => fake()->randomFloat(2, 10, 1000),
                'images' =>
                json_encode([fake()->imageUrl(), fake()->imageUrl(), fake()->imageUrl()]),
                'is_active' => fake()->boolean(true),
                'is_featured' => fake()->boolean(),
                'in_stock' => fake()->boolean(),
                'on_sale' => fake()->boolean(),
            ]);
        }
    }
}
