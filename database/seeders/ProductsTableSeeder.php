<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('products')->insert([
            ['id' => 3, 'name' => 'Áo thun nam', 'desc' => 'Áo thun cotton thoải mái, thích hợp cho mùa hè.', 'price' => 250000, 'discount' => 10, 'status' => 1, 'created_at' => '2024-10-01 03:00:00', 'updated_at' => '2024-10-01 03:05:00'],
            ['id' => 4, 'name' => 'Đầm nữ', 'desc' => 'Đầm nữ xinh xắn, phù hợp cho các buổi tiệc.', 'price' => 400000, 'discount' => 15, 'status' => 1, 'created_at' => '2024-10-02 04:00:00', 'updated_at' => '2024-10-02 04:10:00'],
            ['id' => 5, 'name' => 'Quần short trẻ em', 'desc' => 'Quần short chất liệu nhẹ nhàng, thoải mái.', 'price' => 150000, 'discount' => 5, 'status' => 1, 'created_at' => '2024-10-03 05:00:00', 'updated_at' => '2024-10-03 05:05:00'],
            ['id' => 6, 'name' => 'Giày thể thao', 'desc' => 'Giày thể thao chính hãng, dễ phối đồ.', 'price' => 600000, 'discount' => 20, 'status' => 1, 'created_at' => '2024-10-04 06:00:00', 'updated_at' => '2024-10-04 06:10:00'],
            ['id' => 7, 'name' => 'Túi xách', 'desc' => 'Túi xách thời trang, chất liệu bền bỉ.', 'price' => 350000, 'discount' => 10, 'status' => 1, 'created_at' => '2024-10-05 07:00:00', 'updated_at' => '2024-10-05 07:15:00'],
            ['id' => 8, 'name' => 'Product Example', 'desc' => 'This is a sample product description.', 'price' => 345000, 'discount' => 3, 'status' => 1, 'created_at' => '2024-10-18 22:59:31', 'updated_at' => '2024-10-18 22:59:31'],
            ['id' => 9, 'name' => 'Product example', 'desc' => '<h2>Sản phẩm mẫu</h2>', 'price' => 30000, 'discount' => 0, 'status' => 1, 'created_at' => '2024-10-19 00:45:46', 'updated_at' => '2024-10-19 00:45:46'],
            ['id' => 10, 'name' => 'Shirt', 'desc' => '<p>Sản phẩm mẫu</p>', 'price' => 30000, 'discount' => 0, 'status' => 1, 'created_at' => '2024-10-19 00:48:53', 'updated_at' => '2024-10-19 00:48:53'],
        ]);
    }
}
