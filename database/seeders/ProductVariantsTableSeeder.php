<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductVariantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('product_variants')->insert([
            [ 'product_id' => 1, 'color_id' => 1, 'size_id' => 1, 'quantity' => 10, 'status' => 1, 'created_at' => '2024-10-01 03:00:00', 'updated_at' => '2024-10-01 03:05:00'],
            [ 'product_id' => 2, 'color_id' => 2, 'size_id' => 1, 'quantity' => 5, 'status' => 1, 'created_at' => '2024-10-02 04:00:00', 'updated_at' => '2024-10-02 04:10:00'],
            [ 'product_id' => 3, 'color_id' => 3, 'size_id' => 1, 'quantity' => 15, 'status' => 1, 'created_at' => '2024-10-03 05:00:00', 'updated_at' => '2024-10-03 05:05:00'],
            [ 'product_id' => 4, 'color_id' => 4, 'size_id' => 1, 'quantity' => 20, 'status' => 1, 'created_at' => '2024-10-04 06:00:00', 'updated_at' => '2024-10-04 06:10:00'],
            [ 'product_id' => 5, 'color_id' => 5, 'size_id' => 1, 'quantity' => 12, 'status' => 1, 'created_at' => '2024-10-05 07:00:00', 'updated_at' => '2024-10-05 07:15:00'],
        ]);
    }
}
