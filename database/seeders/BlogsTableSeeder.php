<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BlogsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('blogs')->insert([
            [
                'title' => 'Xu hướng thời trang mùa hè 2024',
                'content' => 'Khám phá những xu hướng thời trang mới nhất cho mùa hè năm 2024, từ màu sắc đến kiểu dáng.',
                'thumbnail' => 'https://res.cloudinary.com/dkfedhd63/image/upload/f_auto,q_auto/jdncwcjuu8efohov113k',
                'user_id' => 1,
                'created_at' => '2024-10-01 03:00:00',
                'updated_at' => '2024-10-01 03:30:00'
            ],
            [
                'title' => 'Phối đồ đi biển hoàn hảo',
                'content' => 'Những gợi ý phối đồ đi biển hoàn hảo để bạn tự tin tỏa sáng trong mùa hè này.',
                'thumbnail' => 'https://res.cloudinary.com/dkfedhd63/image/upload/f_auto,q_auto/nx3kxtrr1jhaplkebwuq',
                'user_id' => 2,
                'created_at' => '2024-10-02 04:00:00',
                'updated_at' => '2024-10-02 04:15:00'
            ],
        ]);
        
    }
}
