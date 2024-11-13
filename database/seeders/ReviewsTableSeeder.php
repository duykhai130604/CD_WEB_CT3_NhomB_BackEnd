<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReviewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // DB::table('reviews')->insert([
        //     [ 'content' => 'Sản phẩm tuyệt vời!', 'rating' => 5, 'user_id' => 1, 'product_id' => 1,'variant'=>1, 'created_at' => '2024-10-01 03:15:00', 'updated_at' => '2024-10-01 03:20:00'],
        //     [ 'content' => 'Chất lượng tốt nhưng giá hơi cao.', 'rating' => 4, 'user_id' => 2,'variant'=>2, 'product_id' => 2, 'created_at' => '2024-10-02 04:15:00', 'updated_at' => '2024-10-02 04:20:00'],
        //     [ 'content' => 'Mình rất thích thiết kế này!', 'rating' => 5, 'user_id' => 1,'variant'=>3, 'product_id' => 3, 'created_at' => '2024-10-03 05:15:00', 'updated_at' => '2024-10-03 05:20:00'],
        //     [ 'content' => 'Thật thoải mái khi mang.', 'rating' => 4, 'user_id' => 3,'variant'=>4, 'product_id' => 4, 'created_at' => '2024-10-04 06:15:00', 'updated_at' => '2024-10-04 06:20:00'],
        //     [ 'content' => 'Túi xách đẹp, nhưng hơi nhỏ.', 'rating' => 3, 'user_id' => 2,'variant'=>5, 'product_id' => 5, 'created_at' => '2024-10-05 07:15:00', 'updated_at' => '2024-10-05 07:20:00'],
        // ]);
        $reviews = [];
        // Tạo 100 bình luận ngẫu nhiên
        for ($i = 1; $i <= 100; $i++) {
            $reviews[] = [
                'content' => 'Bình luận số ' . $i . ': Đây là một sản phẩm tuyệt vời!', // Nội dung bình luận
                'rating' => rand(1, 5), // Random rating từ 1 đến 5
                'user_id' => rand(1, 20), // Random user_id từ 1 đến 20
                'product_id' => rand(1, 20), // Random product_id từ 1 đến 20
                'variant' => rand(1, 60), // Random variant từ 1 đến 60
                'created_at' => now()->subDays(rand(0, 30)), // Random ngày tạo trong vòng 30 ngày qua
                'updated_at' => now()->subDays(rand(0, 30)), // Random ngày cập nhật trong vòng 30 ngày qua
            ];
        }

        // Chèn 100 bình luận vào bảng reviews
        DB::table('reviews')->insert($reviews);
    }
}
