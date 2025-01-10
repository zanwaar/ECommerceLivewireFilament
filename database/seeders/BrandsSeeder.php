<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = [
            [
                'name' => 'Samsung',
                'slug' => 'samsung',
                'is_active' => true
            ],
            [
                'name' => 'Apple',
                'slug' => 'apple',
                'is_active' => true
            ],
            [
                'name' => 'Nike',
                'slug' => 'nike',
                'is_active' => true
            ],
            [
                'name' => 'Adidas',
                'slug' => 'adidas',
                'is_active' => true
            ],
        ];

        foreach ($brands as $brand) {
            Brand::create($brand);
        }
    }
}
