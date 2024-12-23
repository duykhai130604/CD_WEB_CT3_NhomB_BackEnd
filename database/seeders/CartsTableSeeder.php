<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CartsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
{
    DB::table('carts')->insert([
        [ 'user_id' => 1, 'product_variant_id' => 1, 'quantity' => 2, 'created_at' => '2024-10-01 03:00:00', 'updated_at' => '2024-10-01 03:05:00'],
        [ 'user_id' => 2, 'product_variant_id' => 3, 'quantity' => 1, 'created_at' => '2024-10-02 04:00:00', 'updated_at' => '2024-10-02 04:05:00'],
        ['user_id' => 1, 'product_variant_id' => 4, 'quantity' => 3, 'created_at' => '2024-10-03 05:00:00', 'updated_at' => '2024-10-03 05:10:00'],
        [ 'user_id' => 3, 'product_variant_id' => 2, 'quantity' => 1, 'created_at' => '2024-10-04 06:00:00', 'updated_at' => '2024-10-04 06:05:00'],
        [ 'user_id' => 2, 'product_variant_id' => 5, 'quantity' => 4, 'created_at' => '2024-10-05 07:00:00', 'updated_at' => '2024-10-05 07:15:00'],
    ]);
}

}
