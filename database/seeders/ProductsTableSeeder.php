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
            [
                'name' => 'Áo thun nam',
                'desc' => 'Áo thun cotton thoải mái, thích hợp cho mùa hè.',
                'price' => 250000,
                'discount' => 10,
                'status' => 1,
                'thumbnail' => 'https://res.cloudinary.com/dkfedhd63/image/upload/v1730736293/tdxnl4uoedetpcyopkz4.jpg',
                'public_id' => 'ri5xe77zfuhr3qq6lws3',
                'created_at' => '2024-10-01 03:00:00',
                'updated_at' => '2024-10-01 03:05:00'
            ],
            [
                'name' => 'Đầm nữ',
                'desc' => 'Đầm nữ xinh xắn, phù hợp cho các buổi tiệc.',
                'price' => 400000,
                'discount' => 15,
                'status' => 1,
                'thumbnail' => 'https://res.cloudinary.com/dkfedhd63/image/upload/v1730736293/tdxnl4uoedetpcyopkz4.jpg',
                'public_id' => 'hqlitcsnzrx5h2tatm5h',
                'created_at' => '2024-10-02 04:00:00',
                'updated_at' => '2024-10-02 04:10:00'
            ],
            [
                'name' => 'Quần short trẻ em',
                'desc' => 'Quần short chất liệu nhẹ nhàng, thoải mái.',
                'price' => 150000,
                'discount' => 5,
                'status' => 1,
                'thumbnail' => 'https://res.cloudinary.com/dkfedhd63/image/upload/v1730736293/tdxnl4uoedetpcyopkz4.jpg',
                'public_id' => 's6r5gsa9yacxdqnta2m8',
                'created_at' => '2024-10-03 05:00:00',
                'updated_at' => '2024-10-03 05:05:00'
            ],
            [
                'name' => 'Giày thể thao',
                'desc' => 'Giày thể thao chính hãng, dễ phối đồ.',
                'price' => 600000,
                'discount' => 20,
                'status' => 1,
                'thumbnail' => 'https://res.cloudinary.com/dkfedhd63/image/upload/v1730736293/tdxnl4uoedetpcyopkz4.jpg',
                'public_id' => 'gfceerybtfqsizsrtsls',
                'created_at' => '2024-10-04 06:00:00',
                'updated_at' => '2024-10-04 06:10:00'
            ],
            [
                'name' => 'Túi xách',
                'desc' => 'Túi xách thời trang, chất liệu bền bỉ.',
                'price' => 350000,
                'discount' => 10,
                'status' => 1,
                'thumbnail' => 'https://res.cloudinary.com/dkfedhd63/image/upload/v1730736293/tdxnl4uoedetpcyopkz4.jpg',
                'public_id' => 'u7ouyfkiagdpusmmfhdh',
                'created_at' => '2024-10-05 07:00:00',
                'updated_at' => '2024-10-05 07:15:00'
            ],
            [
                'name' => 'Mũ lưỡi trai',
                'desc' => 'Mũ thời trang, phù hợp cho cả nam và nữ.',
                'price' => 80000,
                'discount' => 0,
                'status' => 1,
                'thumbnail' => 'https://res.cloudinary.com/dkfedhd63/image/upload/v1730736293/tdxnl4uoedetpcyopkz4.jpg',
                'public_id' => 's6r5gsa9yacxdqnta2m8',
                'created_at' => '2024-10-18 22:59:31',
                'updated_at' => '2024-10-18 22:59:31'
            ],
            [
                'name' => 'Quần jean nữ',
                'desc' => 'Quần jean ôm sát, tôn dáng.',
                'price' => 320000,
                'discount' => 12,
                'status' => 1,
               'thumbnail' => 'https://res.cloudinary.com/dkfedhd63/image/upload/v1730736293/tdxnl4uoedetpcyopkz4.jpg',
                'public_id' => 's6r5gsa9yacxdqnta2m8',
                'created_at' => '2024-10-19 00:45:46',
                'updated_at' => '2024-10-19 00:45:46'
            ],
            [
                'name' => 'Áo khoác gió',
                'desc' => 'Áo khoác chống nước, phù hợp cho mùa mưa.',
                'price' => 450000,
                'discount' => 15,
                'status' => 1,
                'thumbnail' => 'https://example.com/image8.jpg',
                'public_id' => 'jacket1exampleid',
                'created_at' => '2024-10-08 10:00:00',
                'updated_at' => '2024-10-08 10:10:00'
            ],
            [
                'name' => 'Giày lười nam',
                'desc' => 'Giày lười da, phong cách thanh lịch.',
                'price' => 500000,
                'discount' => 10,
                'status' => 1,
                'thumbnail' => 'https://example.com/image9.jpg',
                'public_id' => 'loafer1exampleid',
                'created_at' => '2024-10-09 11:00:00',
                'updated_at' => '2024-10-09 11:10:00'
            ],
            [
                'name' => 'Balo học sinh',
                'desc' => 'Balo nhẹ nhàng, nhiều ngăn tiện lợi.',
                'price' => 180000,
                'discount' => 8,
                'status' => 1,
                'thumbnail' => 'https://example.com/image10.jpg',
                'public_id' => 'backpack1exampleid',
                'created_at' => '2024-10-10 12:00:00',
                'updated_at' => '2024-10-10 12:10:00'
            ],
            [
                'name' => 'Đồng hồ đeo tay',
                'desc' => 'Đồng hồ chống nước, thiết kế thanh lịch.',
                'price' => 2500000,
                'discount' => 5,
                'status' => 1,
                'thumbnail' => 'https://example.com/image11.jpg',
                'public_id' => 'watch1exampleid',
                'created_at' => '2024-10-11 13:00:00',
                'updated_at' => '2024-10-11 13:10:00'
            ],
            [
                'name' => 'Kính mát',
                'desc' => 'Kính chống UV, phong cách hiện đại.',
                'price' => 120000,
                'discount' => 10,
                'status' => 1,
                'thumbnail' => 'https://example.com/image12.jpg',
                'public_id' => 'sunglass1exampleid',
                'created_at' => '2024-10-12 14:00:00',
                'updated_at' => '2024-10-12 14:10:00'
            ],
            [
                'name' => 'Áo len nữ',
                'desc' => 'Áo len dày, giữ ấm tốt.',
                'price' => 270000,
                'discount' => 15,
                'status' => 1,
                'thumbnail' => 'https://example.com/image13.jpg',
                'public_id' => 'sweater1exampleid',
                'created_at' => '2024-10-13 15:00:00',
                'updated_at' => '2024-10-13 15:10:00'
            ],
            [
                'name' => 'Quần kaki nam',
                'desc' => 'Quần kaki chất liệu cao cấp, dễ chịu.',
                'price' => 280000,
                'discount' => 8,
                'status' => 1,
                'thumbnail' => 'https://example.com/image14.jpg',
                'public_id' => 'chino1exampleid',
                'created_at' => '2024-10-14 16:00:00',
                'updated_at' => '2024-10-14 16:10:00'
            ],
            [
                'name' => 'Nón tai bèo',
                'desc' => 'Nón tai bèo, phong cách Hàn Quốc.',
                'price' => 60000,
                'discount' => 0,
                'status' => 1,
              'thumbnail' => 'https://res.cloudinary.com/dkfedhd63/image/upload/v1730736293/tdxnl4uoedetpcyopkz4.jpg',
                'public_id' => 's6r5gsa9yacxdqnta2m8',
                'created_at' => '2024-10-19 00:48:53',
                'updated_at' => '2024-10-19 00:48:53'
            ],
            [
                'name' => 'Đầm maxi',
                'desc' => 'Đầm maxi phong cách dịu dàng, nữ tính.',
                'price' => 380000,
                'discount' => 12,
                'status' => 1,
                'thumbnail' => 'https://example.com/image16.jpg',
                'public_id' => 'dress1exampleid',
                'created_at' => '2024-10-16 18:00:00',
                'updated_at' => '2024-10-16 18:10:00'
            ],
            [
                'name' => 'Áo sơ mi trắng',
                'desc' => 'Áo sơ mi trắng, phù hợp cho môi trường công sở.',
                'price' => 180000,
                'discount' => 5,
                'status' => 1,
                'thumbnail' => 'https://example.com/image17.jpg',
                'public_id' => 'shirt1exampleid',
                'created_at' => '2024-10-17 19:00:00',
                'updated_at' => '2024-10-17 19:10:00'
            ],
            [
                'name' => 'Giày cao gót nữ',
                'desc' => 'Giày cao gót thanh lịch, giúp tôn dáng.',
                'price' => 520000,
                'discount' => 18,
                'status' => 1,
                'thumbnail' => 'https://example.com/image18.jpg',
                'public_id' => 'heels1exampleid',
                'created_at' => '2024-10-18 20:00:00',
                'updated_at' => '2024-10-18 20:10:00'
            ],
            [
                'name' => 'Bộ quần áo thể thao',
                'desc' => 'Bộ quần áo thể thao co giãn, thoải mái khi vận động.',
                'price' => 300000,
                'discount' => 10,
                'status' => 1,
                'thumbnail' => 'https://example.com/image19.jpg',
                'public_id' => 'sportsuit1exampleid',
                'created_at' => '2024-10-19 21:00:00',
                'updated_at' => '2024-10-19 21:10:00'
            ],
            [
                'name' => 'Váy bodycon',
                'desc' => 'Váy ôm sát body, tôn lên đường cong cơ thể.',
                'price' => 360000,
                'discount' => 15,
                'status' => 1,
                'thumbnail' => 'https://example.com/image20.jpg',
                'public_id' => 'bodycon1exampleid',
                'created_at' => '2024-10-20 22:00:00',
                'updated_at' => '2024-10-20 22:10:00'
            ]
        ]);
    }
}
