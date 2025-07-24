<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'name' => 'Laptop Gaming X1',
                'price' => 15000000.00,
                'description' => 'Laptop gaming berperforma tinggi dengan GPU RTX terbaru.',
                'image' => 'laptop_gaming_x1.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Smartphone Pro Max',
                'price' => 8500000.00,
                'description' => 'Smartphone dengan kamera ultra-wide dan baterai tahan lama.',
                'image' => 'smartphone_pro_max.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Smartwatch Fit 2.0',
                'price' => 1200000.00,
                'description' => 'Smartwatch multifungsi untuk pemantau kesehatan dan notifikasi.',
                'image' => 'smartwatch_fit_2.0.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Headphone Noise Cancelling',
                'price' => 950000.00,
                'description' => 'Headphone premium dengan teknologi noise cancelling canggih.',
                'image' => 'headphone_nc.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Mechanical Keyboard RGB',
                'price' => 700000.00,
                'description' => 'Keyboard mekanikal dengan lampu RGB kustomisasi.',
                'image' => 'keyboard_rgb.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}