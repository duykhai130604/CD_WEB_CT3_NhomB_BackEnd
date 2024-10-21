<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SizesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('sizes')->insert([
            ['id' => 3, 'name' => 'S', 'created_at' => '2024-10-01 03:00:00', 'updated_at' => '2024-10-01 03:05:00'],
            ['id' => 4, 'name' => 'M', 'created_at' => '2024-10-02 04:00:00', 'updated_at' => '2024-10-02 04:10:00'],
            ['id' => 5, 'name' => 'L', 'created_at' => '2024-10-03 05:00:00', 'updated_at' => '2024-10-03 05:05:00'],
            ['id' => 6, 'name' => 'XL', 'created_at' => '2024-10-04 06:00:00', 'updated_at' => '2024-10-04 06:10:00'],
            ['id' => 7, 'name' => 'XXL', 'created_at' => '2024-10-05 07:00:00', 'updated_at' => '2024-10-05 07:15:00'],
        ]);
    }
}
