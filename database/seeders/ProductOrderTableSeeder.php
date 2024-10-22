<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductOrderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // DB::table('product_order')->insert([
        //     ['product_variant_id' => 1, 'order_id' => 1, 'quantity' => 1, 'created_at' => '2024-10-01 03:05:00', 'updated_at' => '2024-10-01 03:10:00'],
        //     ['product_variant_id' => 2, 'order_id' => 2, 'quantity' => 2, 'created_at' => '2024-10-02 04:05:00', 'updated_at' => '2024-10-02 04:10:00'],
        //     ['product_variant_id' => 3, 'order_id' => 1, 'quantity' => 1, 'created_at' => '2024-10-03 05:15:00', 'updated_at' => '2024-10-03 05:20:00'],
        //     ['product_variant_id' => 4, 'order_id' => 3, 'quantity' => 1, 'created_at' => '2024-10-04 06:05:00', 'updated_at' => '2024-10-04 06:10:00'],
        //     ['product_variant_id' => 5, 'order_id' => 2, 'quantity' => 2, 'created_at' => '2024-10-05 07:05:00', 'updated_at' => '2024-10-05 07:10:00'],
        // ]);
    }
}
