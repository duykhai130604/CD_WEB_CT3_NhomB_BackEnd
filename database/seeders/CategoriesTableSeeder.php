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
            // Danh mục chính
            ['parent_id' => 0, 'name' => 'Thời trang nam', 'status' => 1, 'created_at' => '2024-10-01 03:00:00', 'updated_at' => '2024-10-01 03:05:00'],
            ['parent_id' => 0, 'name' => 'Thời trang nữ', 'status' => 1, 'created_at' => '2024-10-02 04:00:00', 'updated_at' => '2024-10-02 04:10:00'],
            ['parent_id' => 0, 'name' => 'Thời trang trẻ em', 'status' => 1, 'created_at' => '2024-10-03 05:00:00', 'updated_at' => '2024-10-03 05:05:00'],
            ['parent_id' => 0, 'name' => 'Giày dép', 'status' => 1, 'created_at' => '2024-10-04 06:00:00', 'updated_at' => '2024-10-04 06:05:00'],
            ['parent_id' => 0, 'name' => 'Phụ kiện', 'status' => 1, 'created_at' => '2024-10-05 07:00:00', 'updated_at' => '2024-10-05 07:10:00'],
        
            // Danh mục con cho "Thời trang nam"
            ['parent_id' => 1, 'name' => 'Áo thun', 'status' => 1, 'created_at' => '2024-10-01 03:10:00', 'updated_at' => '2024-10-01 03:15:00'],
            ['parent_id' => 1, 'name' => 'Giày thể thao', 'status' => 1, 'created_at' => '2024-10-04 06:15:00', 'updated_at' => '2024-10-04 06:20:00'],
            ['parent_id' => 1, 'name' => 'Áo khoác', 'status' => 1, 'created_at' => '2024-10-08 10:00:00', 'updated_at' => '2024-10-08 10:05:00'],
        
            // Danh mục con cho "Thời trang nữ"
            ['parent_id' => 2, 'name' => 'Áo đầm', 'status' => 1, 'created_at' => '2024-10-02 04:15:00', 'updated_at' => '2024-10-02 04:20:00'],
            ['parent_id' => 2, 'name' => 'Giày cao gót', 'status' => 1, 'created_at' => '2024-10-18 20:00:00', 'updated_at' => '2024-10-18 20:05:00'],
            ['parent_id' => 2, 'name' => 'Áo sơ mi', 'status' => 1, 'created_at' => '2024-10-17 19:15:00', 'updated_at' => '2024-10-17 19:20:00'],
        
            // Danh mục con cho "Thời trang trẻ em"
            ['parent_id' => 3, 'name' => 'Áo thun trẻ em', 'status' => 1, 'created_at' => '2024-10-03 05:15:00', 'updated_at' => '2024-10-03 05:20:00'],
            ['parent_id' => 3, 'name' => 'Quần short trẻ em', 'status' => 1, 'created_at' => '2024-10-03 05:25:00', 'updated_at' => '2024-10-03 05:30:00'],
            ['parent_id' => 3, 'name' => 'Váy trẻ em', 'status' => 1, 'created_at' => '2024-10-03 05:35:00', 'updated_at' => '2024-10-03 05:40:00'],
        
            // Danh mục con cho "Giày dép"
            ['parent_id' => 4, 'name' => 'Giày thể thao', 'status' => 1, 'created_at' => '2024-10-04 06:25:00', 'updated_at' => '2024-10-04 06:30:00'],
            ['parent_id' => 4, 'name' => 'Giày lười', 'status' => 1, 'created_at' => '2024-10-09 11:00:00', 'updated_at' => '2024-10-09 11:05:00'],
        
            // Danh mục con cho "Phụ kiện"
            ['parent_id' => 5, 'name' => 'Mũ', 'status' => 1, 'created_at' => '2024-10-06 08:00:00', 'updated_at' => '2024-10-06 08:05:00'],
            ['parent_id' => 5, 'name' => 'Balo', 'status' => 1, 'created_at' => '2024-10-10 12:00:00', 'updated_at' => '2024-10-10 12:05:00'],
            ['parent_id' => 5, 'name' => 'Kính mát', 'status' => 1, 'created_at' => '2024-10-12 14:00:00', 'updated_at' => '2024-10-12 14:05:00'],
            ['parent_id' => 5, 'name' => 'Đồng hồ', 'status' => 1, 'created_at' => '2024-10-11 13:00:00', 'updated_at' => '2024-10-11 13:05:00'],
        ]);
        
    }
}
