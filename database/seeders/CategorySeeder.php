<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'name' => 'Minuman Kopi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Minuman Non-Kopi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Makanan Ringan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dessert',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Menu Spesial',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}