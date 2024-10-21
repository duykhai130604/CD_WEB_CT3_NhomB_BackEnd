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
            ['product_id' => 1, 'category_id' => 1, 'created_at' => '2024-10-01 03:00:00', 'updated_at' => '2024-10-01 03:05:00'],
            ['product_id' => 2, 'category_id' => 2, 'created_at' => '2024-10-02 04:00:00', 'updated_at' => '2024-10-02 04:10:00'],
            ['product_id' => 3, 'category_id' => 3, 'created_at' => '2024-10-03 05:00:00', 'updated_at' => '2024-10-03 05:05:00'],
            ['product_id' => 4, 'category_id' => 4, 'created_at' => '2024-10-04 06:00:00', 'updated_at' => '2024-10-04 06:10:00'],
            ['product_id' => 5, 'category_id' => 5, 'created_at' => '2024-10-05 07:00:00', 'updated_at' => '2024-10-05 07:15:00'],
        ]);
    }
}
