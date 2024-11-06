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
            // Product 1
            ['product_id' => 1, 'color_id' => 1, 'size_id' => 1, 'quantity' => 10, 'status' => 1, 'created_at' => '2024-10-01 03:00:00', 'updated_at' => '2024-10-01 03:05:00'],
            ['product_id' => 1, 'color_id' => 2, 'size_id' => 2, 'quantity' => 8, 'status' => 1, 'created_at' => '2024-10-01 03:10:00', 'updated_at' => '2024-10-01 03:15:00'],
            ['product_id' => 1, 'color_id' => 3, 'size_id' => 3, 'quantity' => 5, 'status' => 1, 'created_at' => '2024-10-01 03:20:00', 'updated_at' => '2024-10-01 03:25:00'],

            // Product 2
            ['product_id' => 2, 'color_id' => 1, 'size_id' => 1, 'quantity' => 15, 'status' => 1, 'created_at' => '2024-10-02 04:00:00', 'updated_at' => '2024-10-02 04:05:00'],
            ['product_id' => 2, 'color_id' => 2, 'size_id' => 2, 'quantity' => 12, 'status' => 1, 'created_at' => '2024-10-02 04:10:00', 'updated_at' => '2024-10-02 04:15:00'],
            ['product_id' => 2, 'color_id' => 3, 'size_id' => 3, 'quantity' => 10, 'status' => 1, 'created_at' => '2024-10-02 04:20:00', 'updated_at' => '2024-10-02 04:25:00'],

            // Product 3
            ['product_id' => 3, 'color_id' => 2, 'size_id' => 1, 'quantity' => 10, 'status' => 1, 'created_at' => '2024-10-03 05:00:00', 'updated_at' => '2024-10-03 05:05:00'],
            ['product_id' => 3, 'color_id' => 4, 'size_id' => 2, 'quantity' => 14, 'status' => 1, 'created_at' => '2024-10-03 05:10:00', 'updated_at' => '2024-10-03 05:15:00'],
            ['product_id' => 3, 'color_id' => 5, 'size_id' => 3, 'quantity' => 8, 'status' => 1, 'created_at' => '2024-10-03 05:20:00', 'updated_at' => '2024-10-03 05:25:00'],

            // Product 4
            ['product_id' => 4, 'color_id' => 3, 'size_id' => 2, 'quantity' => 20, 'status' => 1, 'created_at' => '2024-10-04 06:00:00', 'updated_at' => '2024-10-04 06:05:00'],
            ['product_id' => 4, 'color_id' => 1, 'size_id' => 4, 'quantity' => 10, 'status' => 1, 'created_at' => '2024-10-04 06:10:00', 'updated_at' => '2024-10-04 06:15:00'],
            ['product_id' => 4, 'color_id' => 5, 'size_id' => 5, 'quantity' => 18, 'status' => 1, 'created_at' => '2024-10-04 06:20:00', 'updated_at' => '2024-10-04 06:25:00'],

            // Product 5
            ['product_id' => 5, 'color_id' => 4, 'size_id' => 1, 'quantity' => 12, 'status' => 1, 'created_at' => '2024-10-05 07:00:00', 'updated_at' => '2024-10-05 07:05:00'],
            ['product_id' => 5, 'color_id' => 2, 'size_id' => 3, 'quantity' => 7, 'status' => 1, 'created_at' => '2024-10-05 07:10:00', 'updated_at' => '2024-10-05 07:15:00'],
            ['product_id' => 5, 'color_id' => 3, 'size_id' => 5, 'quantity' => 15, 'status' => 1, 'created_at' => '2024-10-05 07:20:00', 'updated_at' => '2024-10-05 07:25:00'],
            // Product 6
            ['product_id' => 6, 'color_id' => 1, 'size_id' => 1, 'quantity' => 10, 'status' => 1, 'created_at' => '2024-10-06 08:00:00', 'updated_at' => '2024-10-06 08:05:00'],
            ['product_id' => 6, 'color_id' => 2, 'size_id' => 2, 'quantity' => 12, 'status' => 1, 'created_at' => '2024-10-06 08:10:00', 'updated_at' => '2024-10-06 08:15:00'],
            ['product_id' => 6, 'color_id' => 3, 'size_id' => 3, 'quantity' => 8, 'status' => 1, 'created_at' => '2024-10-06 08:20:00', 'updated_at' => '2024-10-06 08:25:00'],

            // Product 7
            ['product_id' => 7, 'color_id' => 4, 'size_id' => 1, 'quantity' => 15, 'status' => 1, 'created_at' => '2024-10-07 09:00:00', 'updated_at' => '2024-10-07 09:05:00'],
            ['product_id' => 7, 'color_id' => 5, 'size_id' => 2, 'quantity' => 10, 'status' => 1, 'created_at' => '2024-10-07 09:10:00', 'updated_at' => '2024-10-07 09:15:00'],
            ['product_id' => 7, 'color_id' => 1, 'size_id' => 3, 'quantity' => 7, 'status' => 1, 'created_at' => '2024-10-07 09:20:00', 'updated_at' => '2024-10-07 09:25:00'],

            // Product 8
            ['product_id' => 8, 'color_id' => 2, 'size_id' => 4, 'quantity' => 20, 'status' => 1, 'created_at' => '2024-10-08 10:00:00', 'updated_at' => '2024-10-08 10:05:00'],
            ['product_id' => 8, 'color_id' => 3, 'size_id' => 1, 'quantity' => 14, 'status' => 1, 'created_at' => '2024-10-08 10:10:00', 'updated_at' => '2024-10-08 10:15:00'],
            ['product_id' => 8, 'color_id' => 5, 'size_id' => 5, 'quantity' => 12, 'status' => 1, 'created_at' => '2024-10-08 10:20:00', 'updated_at' => '2024-10-08 10:25:00'],

            // Product 9
            ['product_id' => 9, 'color_id' => 1, 'size_id' => 2, 'quantity' => 18, 'status' => 1, 'created_at' => '2024-10-09 11:00:00', 'updated_at' => '2024-10-09 11:05:00'],
            ['product_id' => 9, 'color_id' => 4, 'size_id' => 3, 'quantity' => 9, 'status' => 1, 'created_at' => '2024-10-09 11:10:00', 'updated_at' => '2024-10-09 11:15:00'],
            ['product_id' => 9, 'color_id' => 2, 'size_id' => 4, 'quantity' => 11, 'status' => 1, 'created_at' => '2024-10-09 11:20:00', 'updated_at' => '2024-10-09 11:25:00'],

            // Product 10
            ['product_id' => 10, 'color_id' => 3, 'size_id' => 1, 'quantity' => 22, 'status' => 1, 'created_at' => '2024-10-10 12:00:00', 'updated_at' => '2024-10-10 12:05:00'],
            ['product_id' => 10, 'color_id' => 5, 'size_id' => 2, 'quantity' => 14, 'status' => 1, 'created_at' => '2024-10-10 12:10:00', 'updated_at' => '2024-10-10 12:15:00'],
            ['product_id' => 10, 'color_id' => 1, 'size_id' => 4, 'quantity' => 8, 'status' => 1, 'created_at' => '2024-10-10 12:20:00', 'updated_at' => '2024-10-10 12:25:00'],

            // Product 11
            ['product_id' => 11, 'color_id' => 1, 'size_id' => 1, 'quantity' => 10, 'status' => 1, 'created_at' => '2024-10-11 13:00:00', 'updated_at' => '2024-10-11 13:05:00'],
            ['product_id' => 11, 'color_id' => 4, 'size_id' => 2, 'quantity' => 7, 'status' => 1, 'created_at' => '2024-10-11 13:10:00', 'updated_at' => '2024-10-11 13:15:00'],
            ['product_id' => 11, 'color_id' => 5, 'size_id' => 5, 'quantity' => 9, 'status' => 1, 'created_at' => '2024-10-11 13:20:00', 'updated_at' => '2024-10-11 13:25:00'],
            // Product 12
            ['product_id' => 12, 'color_id' => 2, 'size_id' => 3, 'quantity' => 12, 'status' => 1, 'created_at' => '2024-10-12 14:00:00', 'updated_at' => '2024-10-12 14:05:00'],
            ['product_id' => 12, 'color_id' => 3, 'size_id' => 4, 'quantity' => 15, 'status' => 1, 'created_at' => '2024-10-12 14:10:00', 'updated_at' => '2024-10-12 14:15:00'],
            ['product_id' => 12, 'color_id' => 5, 'size_id' => 5, 'quantity' => 9, 'status' => 1, 'created_at' => '2024-10-12 14:20:00', 'updated_at' => '2024-10-12 14:25:00'],

            // Product 13
            ['product_id' => 13, 'color_id' => 1, 'size_id' => 2, 'quantity' => 18, 'status' => 1, 'created_at' => '2024-10-13 15:00:00', 'updated_at' => '2024-10-13 15:05:00'],
            ['product_id' => 13, 'color_id' => 4, 'size_id' => 3, 'quantity' => 10, 'status' => 1, 'created_at' => '2024-10-13 15:10:00', 'updated_at' => '2024-10-13 15:15:00'],
            ['product_id' => 13, 'color_id' => 2, 'size_id' => 4, 'quantity' => 13, 'status' => 1, 'created_at' => '2024-10-13 15:20:00', 'updated_at' => '2024-10-13 15:25:00'],

            // Product 14
            ['product_id' => 14, 'color_id' => 3, 'size_id' => 1, 'quantity' => 20, 'status' => 1, 'created_at' => '2024-10-14 16:00:00', 'updated_at' => '2024-10-14 16:05:00'],
            ['product_id' => 14, 'color_id' => 5, 'size_id' => 2, 'quantity' => 17, 'status' => 1, 'created_at' => '2024-10-14 16:10:00', 'updated_at' => '2024-10-14 16:15:00'],
            ['product_id' => 14, 'color_id' => 1, 'size_id' => 3, 'quantity' => 11, 'status' => 1, 'created_at' => '2024-10-14 16:20:00', 'updated_at' => '2024-10-14 16:25:00'],

            // Product 15
            ['product_id' => 15, 'color_id' => 2, 'size_id' => 5, 'quantity' => 19, 'status' => 1, 'created_at' => '2024-10-15 17:00:00', 'updated_at' => '2024-10-15 17:05:00'],
            ['product_id' => 15, 'color_id' => 3, 'size_id' => 1, 'quantity' => 15, 'status' => 1, 'created_at' => '2024-10-15 17:10:00', 'updated_at' => '2024-10-15 17:15:00'],
            ['product_id' => 15, 'color_id' => 4, 'size_id' => 2, 'quantity' => 8, 'status' => 1, 'created_at' => '2024-10-15 17:20:00', 'updated_at' => '2024-10-15 17:25:00'],

            // Product 16
            ['product_id' => 16, 'color_id' => 5, 'size_id' => 3, 'quantity' => 14, 'status' => 1, 'created_at' => '2024-10-16 18:00:00', 'updated_at' => '2024-10-16 18:05:00'],
            ['product_id' => 16, 'color_id' => 1, 'size_id' => 4, 'quantity' => 18, 'status' => 1, 'created_at' => '2024-10-16 18:10:00', 'updated_at' => '2024-10-16 18:15:00'],
            ['product_id' => 16, 'color_id' => 2, 'size_id' => 5, 'quantity' => 9, 'status' => 1, 'created_at' => '2024-10-16 18:20:00', 'updated_at' => '2024-10-16 18:25:00'],
            // Product 17
            ['product_id' => 17, 'color_id' => 3, 'size_id' => 1, 'quantity' => 21, 'status' => 1, 'created_at' => '2024-10-17 19:00:00', 'updated_at' => '2024-10-17 19:05:00'],
            ['product_id' => 17, 'color_id' => 4, 'size_id' => 2, 'quantity' => 16, 'status' => 1, 'created_at' => '2024-10-17 19:10:00', 'updated_at' => '2024-10-17 19:15:00'],
            ['product_id' => 17, 'color_id' => 5, 'size_id' => 3, 'quantity' => 10, 'status' => 1, 'created_at' => '2024-10-17 19:20:00', 'updated_at' => '2024-10-17 19:25:00'],
            // Product 18
            ['product_id' => 18, 'color_id' => 5, 'size_id' => 3, 'quantity' => 20, 'status' => 1, 'created_at' => '2024-10-18 20:00:00', 'updated_at' => '2024-10-18 20:05:00'],
            ['product_id' => 18, 'color_id' => 2, 'size_id' => 4, 'quantity' => 6, 'status' => 1, 'created_at' => '2024-10-18 20:10:00', 'updated_at' => '2024-10-18 20:15:00'],
            ['product_id' => 18, 'color_id' => 4, 'size_id' => 1, 'quantity' => 11, 'status' => 1, 'created_at' => '2024-10-18 20:20:00', 'updated_at' => '2024-10-18 20:25:00'],
            // Product 19
            ['product_id' => 19, 'color_id' => 1, 'size_id' => 5, 'quantity' => 12, 'status' => 1, 'created_at' => '2024-10-19 21:00:00', 'updated_at' => '2024-10-19 21:05:00'],
            ['product_id' => 19, 'color_id' => 3, 'size_id' => 3, 'quantity' => 8, 'status' => 1, 'created_at' => '2024-10-19 21:10:00', 'updated_at' => '2024-10-19 21:15:00'],
            ['product_id' => 19, 'color_id' => 2, 'size_id' => 2, 'quantity' => 14, 'status' => 1, 'created_at' => '2024-10-19 21:20:00', 'updated_at' => '2024-10-19 21:25:00'],
            // Product 20
            ['product_id' => 20, 'color_id' => 4, 'size_id' => 4, 'quantity' => 19, 'status' => 1, 'created_at' => '2024-10-20 22:00:00', 'updated_at' => '2024-10-20 22:05:00'],
            ['product_id' => 20, 'color_id' => 5, 'size_id' => 1, 'quantity' => 9, 'status' => 1, 'created_at' => '2024-10-20 22:10:00', 'updated_at' => '2024-10-20 22:15:00'],
            ['product_id' => 20, 'color_id' => 2, 'size_id' => 3, 'quantity' => 13, 'status' => 1, 'created_at' => '2024-10-20 22:20:00', 'updated_at' => '2024-10-20 22:25:00'],
        ]);
    }
}
