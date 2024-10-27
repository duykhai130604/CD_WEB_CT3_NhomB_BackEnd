<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('comments')->insert([
            ['user_id' => 1, 'blog_id' => 1, 'content' => 'Bài viết rất hữu ích, cảm ơn!', 'created_at' => '2024-10-01 03:15:00', 'updated_at' => '2024-10-01 03:20:00'],
            [ 'user_id' => 2, 'blog_id' => 1, 'content' => 'Tôi rất thích xu hướng này.', 'created_at' => '2024-10-01 03:30:00', 'updated_at' => '2024-10-01 03:35:00'],
            [ 'user_id' => 1, 'blog_id' => 2, 'content' => 'Phối đồ đi biển thật đẹp!', 'created_at' => '2024-10-02 04:05:00', 'updated_at' => '2024-10-02 04:10:00'],
            [ 'user_id' => 3, 'blog_id' => 3, 'content' => 'Rất nhiều ý tưởng hay!', 'created_at' => '2024-10-03 05:15:00', 'updated_at' => '2024-10-03 05:20:00'],
            [ 'user_id' => 2, 'blog_id' => 4, 'content' => 'Tôi cần một đôi giày như vậy.', 'created_at' => '2024-10-04 06:05:00', 'updated_at' => '2024-10-04 06:10:00'],
        ]);
    }
}
