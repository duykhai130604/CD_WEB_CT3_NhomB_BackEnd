<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('categories')->insert([
            ['id' => 5, 'parent_id' => 0, 'name' => 'Thời trang nam', 'status' => 1, 'created_at' => '2024-10-01 03:00:00', 'updated_at' => '2024-10-01 03:05:00'],
            ['id' => 6, 'parent_id' => 0, 'name' => 'Thời trang nữ', 'status' => 1, 'created_at' => '2024-10-02 04:00:00', 'updated_at' => '2024-10-02 04:10:00'],
            ['id' => 7, 'parent_id' => 0, 'name' => 'Thời trang trẻ em', 'status' => 1, 'created_at' => '2024-10-03 05:00:00', 'updated_at' => '2024-10-03 05:05:00'],
            ['id' => 8, 'parent_id' => 0, 'name' => 'Giày dép', 'status' => 1, 'created_at' => '2024-10-04 06:00:00', 'updated_at' => '2024-10-04 06:05:00'],
            ['id' => 9, 'parent_id' => 0, 'name' => 'Phụ kiện', 'status' => 1, 'created_at' => '2024-10-05 07:00:00', 'updated_at' => '2024-10-05 07:10:00'],
        ]);
    }
}
