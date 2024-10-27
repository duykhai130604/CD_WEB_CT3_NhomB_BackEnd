<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('product_images')->insert([
            [ 'variant_id' => 1, 'url' => 'https://res.cloudinary.com/dkfedhd63/image/upload/f_auto,q_auto/ao_thun_nam.jpg', 'public_id' => 'ao_thun_nam', 'created_at' => '2024-10-01 03:00:00', 'updated_at' => '2024-10-01 03:05:00'],
            [ 'variant_id' => 2, 'url' => 'https://res.cloudinary.com/dkfedhd63/image/upload/f_auto,q_auto/dam_nu.jpg', 'public_id' => 'dam_nu', 'created_at' => '2024-10-02 04:00:00', 'updated_at' => '2024-10-02 04:10:00'],
            [ 'variant_id' => 3, 'url' => 'https://res.cloudinary.com/dkfedhd63/image/upload/f_auto,q_auto/quanngan_trẻ_em.jpg', 'public_id' => 'quanngan_trẻ_em', 'created_at' => '2024-10-03 05:00:00', 'updated_at' => '2024-10-03 05:05:00'],
            [ 'variant_id' => 4, 'url' => 'https://res.cloudinary.com/dkfedhd63/image/upload/f_auto,q_auto/giay_the_thao.jpg', 'public_id' => 'giay_the_thao', 'created_at' => '2024-10-04 06:00:00', 'updated_at' => '2024-10-04 06:10:00'],
            [ 'variant_id' => 5, 'url' => 'https://res.cloudinary.com/dkfedhd63/image/upload/f_auto,q_auto/tui_xach.jpg', 'public_id' => 'tui_xach', 'created_at' => '2024-10-05 07:00:00', 'updated_at' => '2024-10-05 07:15:00'],
        ]);
    }
}
