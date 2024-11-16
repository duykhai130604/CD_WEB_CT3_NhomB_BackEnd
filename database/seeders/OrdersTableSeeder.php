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
            [ 'user_id' => 1,  'phone'=> '0377661111', 'amount' => 500000, 'address' => '123 Đường ABC', 'status' => 1, 'rate'=>false, 'created_at' => '2024-01-01 03:00:00', 'updated_at' => '2024-01-01 03:05:00'],
            [ 'user_id' => 2,  'phone'=> '0377661111', 'amount' => 300000, 'address' => '456 Đường DEF', 'status' => 2, 'rate'=>false, 'created_at' => '2024-02-02 04:00:00', 'updated_at' => '2024-02-02 04:05:00'],
            [ 'user_id' => 3,  'phone'=> '0377661111', 'amount' => 700000, 'address' => '789 Đường GHI', 'status' => 1, 'rate'=>false, 'created_at' => '2024-03-03 05:00:00', 'updated_at' => '2024-03-03 05:10:00'],
            [ 'user_id' => 4,  'phone'=> '0377661111', 'amount' => 1000000, 'address' => '321 Đường JKL', 'status' => 2, 'rate'=>false, 'created_at' => '2024-04-04 06:00:00', 'updated_at' => '2024-04-04 06:15:00'],
            [ 'user_id' => 5,  'phone'=> '0377661111', 'amount' => 250000, 'address' => '654 Đường MNO', 'status' => 1, 'rate'=>false, 'created_at' => '2024-05-05 07:00:00', 'updated_at' => '2024-05-05 07:10:00'],
            [ 'user_id' => 6,  'phone'=> '0377661111', 'amount' => 450000, 'address' => '321 Đường PQR', 'status' => 2, 'rate'=>false, 'created_at' => '2024-06-06 08:00:00', 'updated_at' => '2024-06-06 08:15:00'],
            [ 'user_id' => 7,  'phone'=> '0377661111', 'amount' => 150000, 'address' => '654 Đường STU', 'status' => 1, 'rate'=>false, 'created_at' => '2024-07-07 09:00:00', 'updated_at' => '2024-07-07 09:10:00'],
            [ 'user_id' => 8,  'phone'=> '0377661111', 'amount' => 200000, 'address' => '123 Đường VWX', 'status' => 2, 'rate'=>false, 'created_at' => '2024-08-08 10:00:00', 'updated_at' => '2024-08-08 10:15:00'],
            [ 'user_id' => 9,  'phone'=> '0377661111', 'amount' => 1200000, 'address' => '456 Đường YZ', 'status' => 1, 'rate'=>false, 'created_at' => '2024-09-09 11:00:00', 'updated_at' => '2024-09-09 11:10:00'],
            [ 'user_id' => 10, 'phone'=> '0377661111', 'amount' => 600000, 'address' => '789 Đường ABC', 'status' => 2, 'rate'=>false, 'created_at' => '2024-10-10 12:00:00', 'updated_at' => '2024-10-10 12:15:00'],
            [ 'user_id' => 11, 'phone'=> '0377661111', 'amount' => 750000, 'address' => '123 Đường DEF', 'status' => 1, 'rate'=>false, 'created_at' => '2024-11-11 13:00:00', 'updated_at' => '2024-11-11 13:10:00'],
            [ 'user_id' => 12, 'phone'=> '0377661111', 'amount' => 350000, 'address' => '456 Đường GHI', 'status' => 2, 'rate'=>false, 'created_at' => '2024-12-12 14:00:00', 'updated_at' => '2024-12-12 14:15:00'],
            [ 'user_id' => 13, 'phone'=> '0377661111', 'amount' => 800000, 'address' => '789 Đường JKL', 'status' => 1, 'rate'=>false, 'created_at' => '2024-01-13 15:00:00', 'updated_at' => '2024-01-13 15:10:00'],
            [ 'user_id' => 14, 'phone'=> '0377661111', 'amount' => 900000, 'address' => '321 Đường MNO', 'status' => 2, 'rate'=>false, 'created_at' => '2024-02-14 16:00:00', 'updated_at' => '2024-02-14 16:15:00'],
            [ 'user_id' => 15, 'phone'=> '0377661111', 'amount' => 550000, 'address' => '654 Đường PQR', 'status' => 1, 'rate'=>false, 'created_at' => '2024-03-15 17:00:00', 'updated_at' => '2024-03-15 17:10:00'],
            [ 'user_id' => 16, 'phone'=> '0377661111', 'amount' => 400000, 'address' => '123 Đường STU', 'status' => 2, 'rate'=>false, 'created_at' => '2024-04-16 18:00:00', 'updated_at' => '2024-04-16 18:15:00'],
            [ 'user_id' => 17, 'phone'=> '0377661111', 'amount' => 650000, 'address' => '456 Đường VWX', 'status' => 1, 'rate'=>false, 'created_at' => '2024-05-17 19:00:00', 'updated_at' => '2024-05-17 19:10:00'],
            [ 'user_id' => 18, 'phone'=> '0377661111', 'amount' => 1100000, 'address' => '789 Đường YZ', 'status' => 2, 'rate'=>false, 'created_at' => '2024-06-18 20:00:00', 'updated_at' => '2024-06-18 20:15:00'],
            [ 'user_id' => 19, 'phone'=> '0377661111', 'amount' => 1300000, 'address' => '321 Đường ABC', 'status' => 1, 'rate'=>false, 'created_at' => '2024-07-19 21:00:00', 'updated_at' => '2024-07-19 21:10:00'],
            [ 'user_id' => 20, 'phone'=> '0377661111', 'amount' => 1700000, 'address' => '654 Đường DEF', 'status' => 2, 'rate'=>false, 'created_at' => '2024-08-20 22:00:00', 'updated_at' => '2024-08-20 22:15:00'],
        ]);        
    }
}
