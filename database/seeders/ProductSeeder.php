<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat 1 kategori dummy
        $category = Category::first() ?? Category::create([
            'name' => 'Uncategorized',
        ]);

        // Buat 10 produk dummy
        Product::factory()->count(10)->create([
            'category_id' => $category->id,
        ]);
    }
}
