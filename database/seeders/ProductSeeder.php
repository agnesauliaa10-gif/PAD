<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all();

        if ($categories->isEmpty()) {
            $this->call(CategorySeeder::class);
            $categories = Category::all();
        }

        $aisles = ['Aisle 1', 'Aisle 2', 'Aisle 3', 'Aisle 4', 'Aisle 5'];
        $racks = ['Rack A', 'Rack B', 'Rack C', 'Rack D', 'Rack E'];

        for ($i = 1; $i <= 30; $i++) {
            Product::create([
                'category_id' => $categories->random()->id,
                'name' => 'Product ' . $i,
                'sku' => 'PRD-' . strtoupper(Str::random(6)) . '-' . $i,
                'type' => $i % 2 == 0 ? 'finished_good' : 'raw_material',
                'description' => 'Automated test product description for Product ' . $i,
                'stock' => 0, // Initial stock should be 0, managed by transactions
                'min_stock' => rand(5, 20),
                'unit' => 'Pcs',
                'location' => $aisles[array_rand($aisles)] . ', ' . $racks[array_rand($racks)],
            ]);
        }
    }
}
