<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('orders')->insert([
            [ 'user_id' => 1, 'amount' => 500000, 'address' => '123 Đường ABC', 'status' => 1, 'created_at' => '2024-10-01 03:00:00', 'updated_at' => '2024-10-01 03:05:00'],
            [ 'user_id' => 2, 'amount' => 300000, 'address' => '456 Đường DEF', 'status' => 1, 'created_at' => '2024-10-02 04:00:00', 'updated_at' => '2024-10-02 04:05:00'],
            [ 'user_id' => 1, 'amount' => 700000, 'address' => '789 Đường GHI', 'status' => 2, 'created_at' => '2024-10-03 05:00:00', 'updated_at' => '2024-10-03 05:10:00'],
            [ 'user_id' => 3, 'amount' => 1000000, 'address' => '321 Đường JKL', 'status' => 1, 'created_at' => '2024-10-04 06:00:00', 'updated_at' => '2024-10-04 06:15:00'],
            [ 'user_id' => 2, 'amount' => 250000, 'address' => '654 Đường MNO', 'status' => 1, 'created_at' => '2024-10-05 07:00:00', 'updated_at' => '2024-10-05 07:10:00'],
        ]);
    }
}
