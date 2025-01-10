<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Electronics',
                'slug' => 'electronics',
                'is_active' => true
            ],
            [
                'name' => 'Fashion',
                'slug' => 'fashion',
                'is_active' => true
            ],
            [
                'name' => 'Home & Living',
                'slug' => 'home-living',
                'is_active' => true
            ],
            [
                'name' => 'Sports',
                'slug' => 'sports',
                'is_active' => true
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
