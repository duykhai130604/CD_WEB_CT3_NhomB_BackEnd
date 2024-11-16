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
        DB::table('product_order')->insert([
            ['product_variant_id' => 1, 'order_id' => 1, 'quantity' => 1, 'total' => 500000, 'rate' => false, 'created_at' => '2024-01-01 03:05:00', 'updated_at' => '2024-01-01 03:10:00'],
            ['product_variant_id' => 2, 'order_id' => 2, 'quantity' => 2, 'total' => 600000, 'rate' => false, 'created_at' => '2024-02-02 04:05:00', 'updated_at' => '2024-02-02 04:10:00'],
            ['product_variant_id' => 3, 'order_id' => 1, 'quantity' => 1, 'total' => 700000, 'rate' => false, 'created_at' => '2024-03-03 05:15:00', 'updated_at' => '2024-03-03 05:20:00'],
            ['product_variant_id' => 4, 'order_id' => 3, 'quantity' => 1, 'total' => 800000, 'rate' => false, 'created_at' => '2024-04-04 06:05:00', 'updated_at' => '2024-04-04 06:10:00'],
            ['product_variant_id' => 5, 'order_id' => 2, 'quantity' => 2, 'total' => 1000000, 'rate' => false, 'created_at' => '2024-05-05 07:05:00', 'updated_at' => '2024-05-05 07:10:00'],
            ['product_variant_id' => 6, 'order_id' => 4, 'quantity' => 3, 'total' => 450000, 'rate' => false, 'created_at' => '2024-06-06 08:05:00', 'updated_at' => '2024-06-06 08:10:00'],
            ['product_variant_id' => 7, 'order_id' => 5, 'quantity' => 2, 'total' => 300000, 'rate' => false, 'created_at' => '2024-07-07 09:15:00', 'updated_at' => '2024-07-07 09:20:00'],
            ['product_variant_id' => 8, 'order_id' => 6, 'quantity' => 1, 'total' => 200000, 'rate' => false, 'created_at' => '2024-08-08 10:05:00', 'updated_at' => '2024-08-08 10:10:00'],
            ['product_variant_id' => 9, 'order_id' => 7, 'quantity' => 1, 'total' => 1200000, 'rate' => false, 'created_at' => '2024-09-09 11:05:00', 'updated_at' => '2024-09-09 11:10:00'],
            ['product_variant_id' => 10, 'order_id' => 8, 'quantity' => 2, 'total' => 600000, 'rate' => false, 'created_at' => '2024-10-10 12:05:00', 'updated_at' => '2024-10-10 12:10:00'],
            ['product_variant_id' => 11, 'order_id' => 9, 'quantity' => 3, 'total' => 900000, 'rate' => false, 'created_at' => '2024-11-11 13:15:00', 'updated_at' => '2024-11-11 13:20:00'],
            ['product_variant_id' => 12, 'order_id' => 10, 'quantity' => 1, 'total' => 350000, 'rate' => false, 'created_at' => '2024-12-12 14:05:00', 'updated_at' => '2024-12-12 14:10:00'],
            ['product_variant_id' => 13, 'order_id' => 11, 'quantity' => 1, 'total' => 800000, 'rate' => false, 'created_at' => '2024-01-13 15:05:00', 'updated_at' => '2024-01-13 15:10:00'],
            ['product_variant_id' => 14, 'order_id' => 12, 'quantity' => 2, 'total' => 900000, 'rate' => false, 'created_at' => '2024-02-14 16:15:00', 'updated_at' => '2024-02-14 16:20:00'],
            ['product_variant_id' => 15, 'order_id' => 13, 'quantity' => 1, 'total' => 550000, 'rate' => false, 'created_at' => '2024-03-15 17:05:00', 'updated_at' => '2024-03-15 17:10:00'],
            ['product_variant_id' => 16, 'order_id' => 14, 'quantity' => 3, 'total' => 1200000, 'rate' => false, 'created_at' => '2024-04-16 18:05:00', 'updated_at' => '2024-04-16 18:10:00'],
            ['product_variant_id' => 17, 'order_id' => 15, 'quantity' => 1, 'total' => 700000, 'rate' => false, 'created_at' => '2024-05-17 19:05:00', 'updated_at' => '2024-05-17 19:10:00'],
            ['product_variant_id' => 18, 'order_id' => 16, 'quantity' => 2, 'total' => 800000, 'rate' => false, 'created_at' => '2024-06-18 20:05:00', 'updated_at' => '2024-06-18 20:10:00'],
            ['product_variant_id' => 19, 'order_id' => 17, 'quantity' => 1, 'total' => 650000, 'rate' => false, 'created_at' => '2024-07-19 21:15:00', 'updated_at' => '2024-07-19 21:20:00'],
            ['product_variant_id' => 20, 'order_id' => 18, 'quantity' => 2, 'total' => 1100000, 'rate' => false, 'created_at' => '2024-08-20 22:05:00', 'updated_at' => '2024-08-20 22:10:00'],
            ['product_variant_id' => 21, 'order_id' => 19, 'quantity' => 2, 'total' => 1000000, 'rate' => false, 'created_at' => '2024-09-21 08:00:00', 'updated_at' => '2024-09-21 08:05:00'],
            ['product_variant_id' => 22, 'order_id' => 20, 'quantity' => 3, 'total' => 1500000, 'rate' => false, 'created_at' => '2024-10-22 09:00:00', 'updated_at' => '2024-10-22 09:05:00'],
            ['product_variant_id' => 23, 'order_id' => 1, 'quantity' => 1, 'total' => 300000, 'rate' => false, 'created_at' => '2024-11-23 10:00:00', 'updated_at' => '2024-11-23 10:05:00'],
            ['product_variant_id' => 24, 'order_id' => 2, 'quantity' => 1, 'total' => 400000, 'rate' => false, 'created_at' => '2024-12-24 11:00:00', 'updated_at' => '2024-12-24 11:05:00'],
            ['product_variant_id' => 25, 'order_id' => 3, 'quantity' => 2, 'total' => 800000, 'rate' => false, 'created_at' => '2024-01-25 12:00:00', 'updated_at' => '2024-01-25 12:05:00'],
            ['product_variant_id' => 26, 'order_id' => 4, 'quantity' => 1, 'total' => 200000, 'rate' => false, 'created_at' => '2024-02-26 13:00:00', 'updated_at' => '2024-02-26 13:05:00'],
            ['product_variant_id' => 27, 'order_id' => 5, 'quantity' => 2, 'total' => 700000, 'rate' => false, 'created_at' => '2024-03-27 14:00:00', 'updated_at' => '2024-03-27 14:05:00'],
            ['product_variant_id' => 28, 'order_id' => 6, 'quantity' => 3, 'total' => 1200000, 'rate' => false, 'created_at' => '2024-04-28 15:00:00', 'updated_at' => '2024-04-28 15:05:00'],
            ['product_variant_id' => 29, 'order_id' => 7, 'quantity' => 1, 'total' => 500000, 'rate' => false, 'created_at' => '2024-05-29 16:00:00', 'updated_at' => '2024-05-29 16:05:00'],
            ['product_variant_id' => 30, 'order_id' => 8, 'quantity' => 2, 'total' => 700000, 'rate' => false, 'created_at' => '2024-06-30 17:00:00', 'updated_at' => '2024-06-30 17:05:00'],
            ['product_variant_id' => 31, 'order_id' => 9, 'quantity' => 1, 'total' => 300000, 'rate' => false, 'created_at' => '2024-07-31 18:00:00', 'updated_at' => '2024-07-31 18:05:00'],
            ['product_variant_id' => 32, 'order_id' => 10, 'quantity' => 1, 'total' => 400000, 'rate' => false, 'created_at' => '2024-08-01 19:00:00', 'updated_at' => '2024-08-01 19:05:00'],
            ['product_variant_id' => 33, 'order_id' => 11, 'quantity' => 2, 'total' => 500000, 'rate' => false, 'created_at' => '2024-09-02 20:00:00', 'updated_at' => '2024-09-02 20:05:00'],
            ['product_variant_id' => 34, 'order_id' => 12, 'quantity' => 3, 'total' => 600000, 'rate' => false, 'created_at' => '2024-10-03 21:00:00', 'updated_at' => '2024-10-03 21:05:00'],
            ['product_variant_id' => 35, 'order_id' => 13, 'quantity' => 1, 'total' => 300000, 'rate' => false, 'created_at' => '2024-11-04 22:00:00', 'updated_at' => '2024-11-04 22:05:00'],
            ['product_variant_id' => 36, 'order_id' => 14, 'quantity' => 1, 'total' => 400000, 'rate' => false, 'created_at' => '2024-12-05 23:00:00', 'updated_at' => '2024-12-05 23:05:00'],
            ['product_variant_id' => 37, 'order_id' => 15, 'quantity' => 2, 'total' => 700000, 'rate' => false, 'created_at' => '2024-01-06 00:00:00', 'updated_at' => '2024-01-06 00:05:00'],
            ['product_variant_id' => 38, 'order_id' => 16, 'quantity' => 3, 'total' => 900000, 'rate' => false, 'created_at' => '2024-02-07 01:00:00', 'updated_at' => '2024-02-07 01:05:00'],
            ['product_variant_id' => 39, 'order_id' => 17, 'quantity' => 1, 'total' => 250000, 'rate' => false, 'created_at' => '2024-03-08 02:00:00', 'updated_at' => '2024-03-08 02:05:00'],
            ['product_variant_id' => 40, 'order_id' => 18, 'quantity' => 2, 'total' => 600000, 'rate' => false, 'created_at' => '2024-04-09 03:00:00', 'updated_at' => '2024-04-09 03:05:00'],
        ]);
    }
}
