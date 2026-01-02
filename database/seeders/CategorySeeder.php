<?php

namespace Database\Seeders;

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
            ['name' => 'Electronics', 'description' => 'Electronic devices and accessories'],
            ['name' => 'Furniture', 'description' => 'Office and home furniture'],
            ['name' => 'Stationery', 'description' => 'Office supplies'],
            ['name' => 'Raw Materials', 'description' => 'Materials for production'],
            ['name' => 'Packaging', 'description' => 'Boxes, tapes, and wrapping materials'],
        ];

        foreach ($categories as $category) {
            \App\Models\Category::create($category);
        }
    }
}
