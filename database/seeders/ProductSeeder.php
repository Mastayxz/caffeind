<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Category; // Import Model Category

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kopiId = Category::where('name', 'Minuman Kopi')->first()->id ?? null;
        $nonKopiId = Category::where('name', 'Minuman Non-Kopi')->first()->id ?? null;
        $makananRinganId = Category::where('name', 'Makanan Ringan')->first()->id ?? null;
        $dessertId = Category::where('name', 'Dessert')->first()->id ?? null;

        if ($kopiId && $nonKopiId && $makananRinganId && $dessertId) {
            DB::table('products')->insert([
                // Minuman Kopi
                [
                    'name' => 'Espresso',
                    'price' => 25000.00,
                    'description' => 'Ekstrak kopi murni yang kaya rasa.',
                    'stock' => 100, 
                    'category_id' => $kopiId,
                    'image' => 'espresso.jpg',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'Cappuccino',
                    'price' => 35000.00,
                    'description' => 'Kopi susu klasik dengan busa tebal.',
                    'stock' => 80,
                    'category_id' => $kopiId,
                    'image' => 'cappuccino.jpg',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'Latte',
                    'price' => 38000.00,
                    'description' => 'Kopi susu lembut dengan sentuhan seni latte.',
                    'stock' => 85,
                    'category_id' => $kopiId,
                    'image' => 'latte.jpg',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'Americano',
                    'price' => 30000.00,
                    'description' => 'Espresso yang dilarutkan dengan air panas.',
                    'stock' => 90,
                    'category_id' => $kopiId,
                    'image' => 'americano.jpg',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],

                // Minuman Non-Kopi
                [
                    'name' => 'Matcha Latte',
                    'price' => 40000.00,
                    'description' => 'Minuman teh hijau Jepang dengan susu.',
                    'stock' => 60,
                    'category_id' => $nonKopiId,
                    'image' => 'matcha_latte.jpg',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'Chocolate Dingin',
                    'price' => 38000.00,
                    'description' => 'Cokelat kaya rasa disajikan dingin.',
                    'stock' => 70,
                    'category_id' => $nonKopiId,
                    'image' => 'chocolate_dingin.jpg',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'Lemon Tea',
                    'price' => 28000.00,
                    'description' => 'Teh segar dengan irisan lemon.',
                    'stock' => 95,
                    'category_id' => $nonKopiId,
                    'image' => 'lemon_tea.jpg',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],

                // Makanan Ringan
                [
                    'name' => 'Kentang Goreng',
                    'price' => 25000.00,
                    'description' => 'Kentang goreng renyah disajikan dengan saus.',
                    'stock' => 50,
                    'category_id' => $makananRinganId,
                    'image' => 'kentang_goreng.jpg',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'Roti Bakar Keju',
                    'price' => 30000.00,
                    'description' => 'Roti bakar dengan lelehan keju mozarella.',
                    'stock' => 40,
                    'category_id' => $makananRinganId,
                    'image' => 'roti_bakar_keju.jpg',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],

                // Dessert
                [
                    'name' => 'Cheesecake',
                    'price' => 45000.00,
                    'description' => 'Kue keju lembut dengan topping pilihan.',
                    'stock' => 20,
                    'category_id' => $dessertId,
                    'image' => 'cheesecake.jpg',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'Brownie Fudge',
                    'price' => 35000.00,
                    'description' => 'Brownie cokelat padat dengan taburan kacang.',
                    'stock' => 25,
                    'category_id' => $dessertId,
                    'image' => 'brownie_fudge.jpg',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
        } else {
            echo "Peringatan: Kategori kafe tidak ditemukan. Pastikan CategorySeeder berjalan sebelum ProductSeeder.\n";
        }
    }
}