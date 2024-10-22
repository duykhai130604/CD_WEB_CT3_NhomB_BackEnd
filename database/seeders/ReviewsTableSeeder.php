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
        DB::table('reviews')->insert([
            ['id' => 3, 'content' => 'Sản phẩm tuyệt vời!', 'rating' => 5, 'user_id' => 1, 'product_id' => 1, 'created_at' => '2024-10-01 03:15:00', 'updated_at' => '2024-10-01 03:20:00'],
            ['id' => 4, 'content' => 'Chất lượng tốt nhưng giá hơi cao.', 'rating' => 4, 'user_id' => 2, 'product_id' => 2, 'created_at' => '2024-10-02 04:15:00', 'updated_at' => '2024-10-02 04:20:00'],
            ['id' => 5, 'content' => 'Mình rất thích thiết kế này!', 'rating' => 5, 'user_id' => 1, 'product_id' => 3, 'created_at' => '2024-10-03 05:15:00', 'updated_at' => '2024-10-03 05:20:00'],
            ['id' => 6, 'content' => 'Thật thoải mái khi mang.', 'rating' => 4, 'user_id' => 3, 'product_id' => 4, 'created_at' => '2024-10-04 06:15:00', 'updated_at' => '2024-10-04 06:20:00'],
            ['id' => 7, 'content' => 'Túi xách đẹp, nhưng hơi nhỏ.', 'rating' => 3, 'user_id' => 2, 'product_id' => 5, 'created_at' => '2024-10-05 07:15:00', 'updated_at' => '2024-10-05 07:20:00'],
        ]);
    }
}
