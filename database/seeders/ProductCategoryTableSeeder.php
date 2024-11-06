<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('product_category')->insert([
                ['category_id' => 1, 'product_id' => 1], // Áo thun nam
                ['category_id' => 1, 'product_id' => 2], // Đầm nữ
                ['category_id' => 1, 'product_id' => 3], // Quần short trẻ em
                ['category_id' => 1, 'product_id' => 4], // Giày thể thao
                ['category_id' => 1, 'product_id' => 5], // Túi xách
                ['category_id' => 1, 'product_id' => 6], // Sản phẩm mẫu
                ['category_id' => 1, 'product_id' => 7], // Sản phẩm ví dụ
                ['category_id' => 1, 'product_id' => 8], // Áo sơ mi
                // Thời trang nữ
                ['category_id' => 2, 'product_id' => 9], // Áo thun nữ
                ['category_id' => 2, 'product_id' => 10], // Quần jeans nữ
                ['category_id' => 2, 'product_id' => 11], // Đầm công sở
                ['category_id' => 2, 'product_id' => 12], // Áo blouse
                ['category_id' => 2, 'product_id' => 13], // Váy dạ hội
                ['category_id' => 2, 'product_id' => 14], // Áo khoác nữ
            
                // Thời trang trẻ em
                ['category_id' => 3, 'product_id' => 15], // Áo thun trẻ em
                ['category_id' => 3, 'product_id' => 16], // Quần short bé trai
                ['category_id' => 3, 'product_id' => 17], // Váy trẻ em
                ['category_id' => 3, 'product_id' => 18], // Áo len trẻ em
                ['category_id' => 3, 'product_id' => 19], // Quần dài bé gái
                ['category_id' => 3, 'product_id' => 20], // Áo sơ mi trẻ em
                // Giày dép
                ['category_id' => 4, 'product_id' => 4], // Giày thể thao
                ['category_id' => 4, 'product_id' => 7], // Giày lười
                // Phụ kiện
                ['category_id' => 5, 'product_id' => 6], // Mũ
                ['category_id' => 5, 'product_id' => 8], // Balo
                ['category_id' => 5, 'product_id' => 9], // Kính mát
                ['category_id' => 5, 'product_id' => 10], // Đồng hồ
            
        ]);
    }
}
