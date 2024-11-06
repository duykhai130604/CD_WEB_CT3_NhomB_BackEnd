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
            ['variant_id' => 1, 'url' => 'https://res.cloudinary.com/dkfedhd63/image/upload/f_auto,q_auto/ao_thun_nam.jpg', 'public_id' => 'ao_thun_nam', 'created_at' => '2024-10-01 03:00:00', 'updated_at' => '2024-10-01 03:05:00'],
            ['variant_id' => 2, 'url' => 'https://res.cloudinary.com/dkfedhd63/image/upload/f_auto,q_auto/dam_nu.jpg', 'public_id' => 'dam_nu', 'created_at' => '2024-10-02 04:00:00', 'updated_at' => '2024-10-02 04:10:00'],
            ['variant_id' => 3, 'url' => 'https://res.cloudinary.com/dkfedhd63/image/upload/f_auto,q_auto/quanngan_trẻ_em.jpg', 'public_id' => 'quanngan_trẻ_em', 'created_at' => '2024-10-03 05:00:00', 'updated_at' => '2024-10-03 05:05:00'],
            ['variant_id' => 4, 'url' => 'https://res.cloudinary.com/dkfedhd63/image/upload/f_auto,q_auto/giay_the_thao.jpg', 'public_id' => 'giay_the_thao', 'created_at' => '2024-10-04 06:00:00', 'updated_at' => '2024-10-04 06:10:00'],
            ['variant_id' => 5, 'url' => 'https://res.cloudinary.com/dkfedhd63/image/upload/f_auto,q_auto/tui_xach.jpg', 'public_id' => 'tui_xach', 'created_at' => '2024-10-05 07:00:00', 'updated_at' => '2024-10-05 07:15:00'],
            // Product Image Variants 6-10
            ['variant_id' => 6, 'url' => 'https://res.cloudinary.com/dkfedhd63/image/upload/f_auto,q_auto/ao_khoac_nam.jpg', 'public_id' => 'ao_khoac_nam', 'created_at' => '2024-10-06 08:00:00', 'updated_at' => '2024-10-06 08:05:00'],
            ['variant_id' => 7, 'url' => 'https://res.cloudinary.com/dkfedhd63/image/upload/f_auto,q_auto/kinh_mat.jpg', 'public_id' => 'kinh_mat', 'created_at' => '2024-10-07 09:00:00', 'updated_at' => '2024-10-07 09:05:00'],
            ['variant_id' => 8, 'url' => 'https://res.cloudinary.com/dkfedhd63/image/upload/f_auto,q_auto/quan_jeans.jpg', 'public_id' => 'quan_jeans', 'created_at' => '2024-10-08 10:00:00', 'updated_at' => '2024-10-08 10:05:00'],
            ['variant_id' => 9, 'url' => 'https://res.cloudinary.com/dkfedhd63/image/upload/f_auto,q_auto/vay_dam.jpg', 'public_id' => 'vay_dam', 'created_at' => '2024-10-09 11:00:00', 'updated_at' => '2024-10-09 11:05:00'],
            ['variant_id' => 10, 'url' => 'https://res.cloudinary.com/dkfedhd63/image/upload/f_auto,q_auto/dong_ho.jpg', 'public_id' => 'dong_ho', 'created_at' => '2024-10-10 12:00:00', 'updated_at' => '2024-10-10 12:05:00'],
            // Product Image Variants 11-15
            ['variant_id' => 11, 'url' => 'https://res.cloudinary.com/dkfedhd63/image/upload/f_auto,q_auto/non_luoi_tra.jpg', 'public_id' => 'non_luoi_tra', 'created_at' => '2024-10-11 13:00:00', 'updated_at' => '2024-10-11 13:05:00'],
            ['variant_id' => 12, 'url' => 'https://res.cloudinary.com/dkfedhd63/image/upload/f_auto,q_auto/ao_somi.jpg', 'public_id' => 'ao_somi', 'created_at' => '2024-10-12 14:00:00', 'updated_at' => '2024-10-12 14:05:00'],
            ['variant_id' => 13, 'url' => 'https://res.cloudinary.com/dkfedhd63/image/upload/f_auto,q_auto/giay_cao_got.jpg', 'public_id' => 'giay_cao_got', 'created_at' => '2024-10-13 15:00:00', 'updated_at' => '2024-10-13 15:05:00'],
            ['variant_id' => 14, 'url' => 'https://res.cloudinary.com/dkfedhd63/image/upload/f_auto,q_auto/balo.jpg', 'public_id' => 'balo', 'created_at' => '2024-10-14 16:00:00', 'updated_at' => '2024-10-14 16:05:00'],
            ['variant_id' => 15, 'url' => 'https://res.cloudinary.com/dkfedhd63/image/upload/f_auto,q_auto/vo_doi.jpg', 'public_id' => 'vo_doi', 'created_at' => '2024-10-15 17:00:00', 'updated_at' => '2024-10-15 17:05:00'],
            // Product Image Variants 16-20
            ['variant_id' => 16, 'url' => 'https://res.cloudinary.com/dkfedhd63/image/upload/f_auto,q_auto/mu_len.jpg', 'public_id' => 'mu_len', 'created_at' => '2024-10-16 18:00:00', 'updated_at' => '2024-10-16 18:05:00'],
            ['variant_id' => 17, 'url' => 'https://res.cloudinary.com/dkfedhd63/image/upload/f_auto,q_auto/vong_tay.jpg', 'public_id' => 'vong_tay', 'created_at' => '2024-10-17 19:00:00', 'updated_at' => '2024-10-17 19:05:00'],
            ['variant_id' => 18, 'url' => 'https://res.cloudinary.com/dkfedhd63/image/upload/f_auto,q_auto/day_nit.jpg', 'public_id' => 'day_nit', 'created_at' => '2024-10-18 20:00:00', 'updated_at' => '2024-10-18 20:05:00'],
            ['variant_id' => 19, 'url' => 'https://res.cloudinary.com/dkfedhd63/image/upload/f_auto,q_auto/ao_thun_in_chu.jpg', 'public_id' => 'ao_thun_in_chu', 'created_at' => '2024-10-19 21:00:00', 'updated_at' => '2024-10-19 21:05:00'],
            ['variant_id' => 20, 'url' => 'https://res.cloudinary.com/dkfedhd63/image/upload/f_auto,q_auto/giay_luoi.jpg', 'public_id' => 'giay_luoi', 'created_at' => '2024-10-20 22:00:00', 'updated_at' => '2024-10-20 22:05:00'],
            // Product Image Variants 21-30
            ['variant_id' => 21, 'url' => 'https://res.cloudinary.com/dkfedhd63/image/upload/f_auto,q_auto/ao_thun_hoa_tiet.jpg', 'public_id' => 'ao_thun_hoa_tiet', 'created_at' => '2024-10-21 09:00:00', 'updated_at' => '2024-10-21 09:05:00'],
            ['variant_id' => 22, 'url' => 'https://res.cloudinary.com/dkfedhd63/image/upload/f_auto,q_auto/dam_hoa.jpg', 'public_id' => 'dam_hoa', 'created_at' => '2024-10-22 10:00:00', 'updated_at' => '2024-10-22 10:05:00'],
            ['variant_id' => 23, 'url' => 'https://res.cloudinary.com/dkfedhd63/image/upload/f_auto,q_auto/quan_kaki.jpg', 'public_id' => 'quan_kaki', 'created_at' => '2024-10-23 11:00:00', 'updated_at' => '2024-10-23 11:05:00'],
            ['variant_id' => 24, 'url' => 'https://res.cloudinary.com/dkfedhd63/image/upload/f_auto,q_auto/giay_loafer.jpg', 'public_id' => 'giay_loafer', 'created_at' => '2024-10-24 12:00:00', 'updated_at' => '2024-10-24 12:05:00'],
            ['variant_id' => 25, 'url' => 'https://res.cloudinary.com/dkfedhd63/image/upload/f_auto,q_auto/tui_xach_nu.jpg', 'public_id' => 'tui_xach_nu', 'created_at' => '2024-10-25 13:00:00', 'updated_at' => '2024-10-25 13:05:00'],
            ['variant_id' => 26, 'url' => 'https://res.cloudinary.com/dkfedhd63/image/upload/f_auto,q_auto/kinh_thoi_trang.jpg', 'public_id' => 'kinh_thoi_trang', 'created_at' => '2024-10-26 14:00:00', 'updated_at' => '2024-10-26 14:05:00'],
            ['variant_id' => 27, 'url' => 'https://res.cloudinary.com/dkfedhd63/image/upload/f_auto,q_auto/non_bao_hoi.jpg', 'public_id' => 'non_bao_hoi', 'created_at' => '2024-10-27 15:00:00', 'updated_at' => '2024-10-27 15:05:00'],
            ['variant_id' => 28, 'url' => 'https://res.cloudinary.com/dkfedhd63/image/upload/f_auto,q_auto/ao_khoac_gio.jpg', 'public_id' => 'ao_khoac_gio', 'created_at' => '2024-10-28 16:00:00', 'updated_at' => '2024-10-28 16:05:00'],
            ['variant_id' => 29, 'url' => 'https://res.cloudinary.com/dkfedhd63/image/upload/f_auto,q_auto/giay_chet_tay.jpg', 'public_id' => 'giay_chet_tay', 'created_at' => '2024-10-29 17:00:00', 'updated_at' => '2024-10-29 17:05:00'],
            ['variant_id' => 30, 'url' => 'https://res.cloudinary.com/dkfedhd63/image/upload/f_auto,q_auto/giay_bup_be.jpg', 'public_id' => 'giay_bup_be', 'created_at' => '2024-10-30 18:00:00', 'updated_at' => '2024-10-30 18:05:00'],
            // Product Image Variants 31-40
            ['variant_id' => 31, 'url' => 'https://res.cloudinary.com/dkfedhd63/image/upload/f_auto,q_auto/tui_da.jpg', 'public_id' => 'tui_da', 'created_at' => '2024-10-31 09:00:00', 'updated_at' => '2024-10-31 09:05:00'],
            ['variant_id' => 32, 'url' => 'https://res.cloudinary.com/dkfedhd63/image/upload/f_auto,q_auto/vo_nu.jpg', 'public_id' => 'vo_nu', 'created_at' => '2024-11-01 10:00:00', 'updated_at' => '2024-11-01 10:05:00'],
            ['variant_id' => 33, 'url' => 'https://res.cloudinary.com/dkfedhd63/image/upload/f_auto,q_auto/ao_thun_tay_dai.jpg', 'public_id' => 'ao_thun_tay_dai', 'created_at' => '2024-11-02 11:00:00', 'updated_at' => '2024-11-02 11:05:00'],
            ['variant_id' => 34, 'url' => 'https://res.cloudinary.com/dkfedhd63/image/upload/f_auto,q_auto/balo_nam.jpg', 'public_id' => 'balo_nam', 'created_at' => '2024-11-03 12:00:00', 'updated_at' => '2024-11-03 12:05:00'],
            ['variant_id' => 35, 'url' => 'https://res.cloudinary.com/dkfedhd63/image/upload/f_auto,q_auto/non_casual.jpg', 'public_id' => 'non_casual', 'created_at' => '2024-11-04 13:00:00', 'updated_at' => '2024-11-04 13:05:00'],
            ['variant_id' => 36, 'url' => 'https://res.cloudinary.com/dkfedhd63/image/upload/f_auto,q_auto/kinh_nam.jpg', 'public_id' => 'kinh_nam', 'created_at' => '2024-11-05 14:00:00', 'updated_at' => '2024-11-05 14:05:00'],
            ['variant_id' => 37, 'url' => 'https://res.cloudinary.com/dkfedhd63/image/upload/f_auto,q_auto/giay_da_bong.jpg', 'public_id' => 'giay_da_bong', 'created_at' => '2024-11-06 15:00:00', 'updated_at' => '2024-11-06 15:05:00'],
            ['variant_id' => 38, 'url' => 'https://res.cloudinary.com/dkfedhd63/image/upload/f_auto,q_auto/ao_thun_co.jpg', 'public_id' => 'ao_thun_co', 'created_at' => '2024-11-07 16:00:00', 'updated_at' => '2024-11-07 16:05:00'],
            ['variant_id' => 39, 'url' => 'https://res.cloudinary.com/dkfedhd63/image/upload/f_auto,q_auto/tui_vai.jpg', 'public_id' => 'tui_vai', 'created_at' => '2024-11-08 17:00:00', 'updated_at' => '2024-11-08 17:05:00'],
            ['variant_id' => 40, 'url' => 'https://res.cloudinary.com/dkfedhd63/image/upload/f_auto,q_auto/balo_nu.jpg', 'public_id' => 'balo_nu', 'created_at' => '2024-11-09 18:00:00', 'updated_at' => '2024-11-09 18:05:00'],
            // Product Image Variants 41-60
            ['variant_id' => 41, 'url' => 'https://res.cloudinary.com/dkfedhd63/image/upload/f_auto,q_auto/giay_van_phong.jpg', 'public_id' => 'giay_van_phong', 'created_at' => '2024-11-10 09:00:00', 'updated_at' => '2024-11-10 09:05:00'],
            ['variant_id' => 42, 'url' => 'https://res.cloudinary.com/dkfedhd63/image/upload/f_auto,q_auto/ao_lanh.jpg', 'public_id' => 'ao_lanh', 'created_at' => '2024-11-11 10:00:00', 'updated_at' => '2024-11-11 10:05:00'],
            ['variant_id' => 43, 'url' => 'https://res.cloudinary.com/dkfedhd63/image/upload/f_auto,q_auto/vay_hoa.jpg', 'public_id' => 'vay_hoa', 'created_at' => '2024-11-12 11:00:00', 'updated_at' => '2024-11-12 11:05:00'],
            ['variant_id' => 44, 'url' => 'https://res.cloudinary.com/dkfedhd63/image/upload/f_auto,q_auto/day_nit_da.jpg', 'public_id' => 'day_nit_da', 'created_at' => '2024-11-13 12:00:00', 'updated_at' => '2024-11-13 12:05:00'],
            ['variant_id' => 45, 'url' => 'https://res.cloudinary.com/dkfedhd63/image/upload/f_auto,q_auto/giay_nu.jpg', 'public_id' => 'giay_nu', 'created_at' => '2024-11-14 13:00:00', 'updated_at' => '2024-11-14 13:05:00'],
            ['variant_id' => 46, 'url' => 'https://res.cloudinary.com/dkfedhd63/image/upload/f_auto,q_auto/quan_jogger.jpg', 'public_id' => 'quan_jogger', 'created_at' => '2024-11-15 14:00:00', 'updated_at' => '2024-11-15 14:05:00'],
            ['variant_id' => 47, 'url' => 'https://res.cloudinary.com/dkfedhd63/image/upload/f_auto,q_auto/ao_sweater.jpg', 'public_id' => 'ao_sweater', 'created_at' => '2024-11-16 15:00:00', 'updated_at' => '2024-11-16 15:05:00'],
            ['variant_id' => 48, 'url' => 'https://res.cloudinary.com/dkfedhd63/image/upload/f_auto,q_auto/balo_nang.jpg', 'public_id' => 'balo_nang', 'created_at' => '2024-11-17 16:00:00', 'updated_at' => '2024-11-17 16:05:00'],
            ['variant_id' => 49, 'url' => 'https://res.cloudinary.com/dkfedhd63/image/upload/f_auto,q_auto/ao_phong.jpg', 'public_id' => 'ao_phong', 'created_at' => '2024-11-18 17:00:00', 'updated_at' => '2024-11-18 17:05:00'],
            ['variant_id' => 50, 'url' => 'https://res.cloudinary.com/dkfedhd63/image/upload/f_auto,q_auto/kinh_cool.jpg', 'public_id' => 'kinh_cool', 'created_at' => '2024-11-19 18:00:00', 'updated_at' => '2024-11-19 18:05:00'],
            ['variant_id' => 51, 'url' => 'https://res.cloudinary.com/dkfedhd63/image/upload/f_auto,q_auto/kinh_sieu_anh_hung.jpg', 'public_id' => 'kinh_sieu_anh_hung', 'created_at' => '2024-11-20 09:00:00', 'updated_at' => '2024-11-20 09:05:00'],
            ['variant_id' => 52, 'url' => 'https://res.cloudinary.com/dkfedhd63/image/upload/f_auto,q_auto/tui_cam_tay.jpg', 'public_id' => 'tui_cam_tay', 'created_at' => '2024-11-21 10:00:00', 'updated_at' => '2024-11-21 10:05:00'],
            ['variant_id' => 53, 'url' => 'https://res.cloudinary.com/dkfedhd63/image/upload/f_auto,q_auto/giay_sneaker.jpg', 'public_id' => 'giay_sneaker', 'created_at' => '2024-11-22 11:00:00', 'updated_at' => '2024-11-22 11:05:00'],
            ['variant_id' => 54, 'url' => 'https://res.cloudinary.com/dkfedhd63/image/upload/f_auto,q_auto/vay_ngoai_cung.jpg', 'public_id' => 'vay_ngoai_cung', 'created_at' => '2024-11-23 12:00:00', 'updated_at' => '2024-11-23 12:05:00'],
            ['variant_id' => 55, 'url' => 'https://res.cloudinary.com/dkfedhd63/image/upload/f_auto,q_auto/kinh_mot.jpg', 'public_id' => 'kinh_mot', 'created_at' => '2024-11-24 13:00:00', 'updated_at' => '2024-11-24 13:05:00'],
            ['variant_id' => 56, 'url' => 'https://res.cloudinary.com/dkfedhd63/image/upload/f_auto,q_auto/ao_khoac_ngan.jpg', 'public_id' => 'ao_khoac_ngan', 'created_at' => '2024-11-25 14:00:00', 'updated_at' => '2024-11-25 14:05:00'],
            ['variant_id' => 57, 'url' => 'https://res.cloudinary.com/dkfedhd63/image/upload/f_auto,q_auto/non_the_thao.jpg', 'public_id' => 'non_the_thao', 'created_at' => '2024-11-26 15:00:00', 'updated_at' => '2024-11-26 15:05:00'],
            ['variant_id' => 58, 'url' => 'https://res.cloudinary.com/dkfedhd63/image/upload/f_auto,q_auto/giay_linh_hoat.jpg', 'public_id' => 'giay_linh_hoat', 'created_at' => '2024-11-27 16:00:00', 'updated_at' => '2024-11-27 16:05:00'],
            ['variant_id' => 59, 'url' => 'https://res.cloudinary.com/dkfedhd63/image/upload/f_auto,q_auto/tui_hang_hieu.jpg', 'public_id' => 'tui_hang_hieu', 'created_at' => '2024-11-28 17:00:00', 'updated_at' => '2024-11-28 17:05:00'],
            ['variant_id' => 60, 'url' => 'https://res.cloudinary.com/dkfedhd63/image/upload/f_auto,q_auto/vong_tay_ngoc.jpg', 'public_id' => 'vong_tay_ngoc', 'created_at' => '2024-11-29 18:00:00', 'updated_at' => '2024-11-29 18:05:00'],
        ]);
    }
}
