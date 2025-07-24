<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User; 
use App\Models\Product; 

class CartSeeder extends Seeder
{
    public function run(): void
    {
        $user1 = User::first();
        $user2 = User::skip(1)->first();

        $product1 = Product::first(); 
        $product2 = Product::skip(1)->first(); 
        $product3 = Product::skip(2)->first(); 
        if ($user1 && $user2 && $product1 && $product2 && $product3) {
            DB::table('carts')->insert([
                [
                    'user_id' => $user1->id,
                    'product_id' => $product1->id,
                    'quantity' => 2,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'user_id' => $user1->id,
                    'product_id' => $product2->id,
                    'quantity' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'user_id' => $user2->id,
                    'product_id' => $product3->id,
                    'quantity' => 3,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
        } else {
            echo "Warning: Not enough users or products found to seed carts. Please run UserSeeder and ensure products exist.\n";
        }
    }
}