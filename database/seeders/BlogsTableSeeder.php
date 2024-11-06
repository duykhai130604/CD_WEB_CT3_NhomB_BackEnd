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
                'status' => 1,
                'created_at' => '2024-10-01 03:00:00',
                'updated_at' => '2024-10-01 03:30:00'
            ],
            [
                'title' => 'Phối đồ đi biển hoàn hảo',
                'content' => 'Những gợi ý phối đồ đi biển hoàn hảo để bạn tự tin tỏa sáng trong mùa hè này.',
                'thumbnail' => 'https://res.cloudinary.com/dkfedhd63/image/upload/f_auto,q_auto/nx3kxtrr1jhaplkebwuq',
                'user_id' => 2,
                'status' => 1,
                'created_at' => '2024-10-02 04:00:00',
                'updated_at' => '2024-10-02 04:15:00'
            ],
            [
                'title' => '5 món đồ không thể thiếu trong tủ đồ mùa thu',
                'content' => 'Khám phá 5 món đồ cơ bản giúp bạn chuẩn bị cho mùa thu dễ dàng và thời trang.',
                'thumbnail' => 'https://res.cloudinary.com/dkfedhd63/image/upload/f_auto,q_auto/zdvlwvjxrsodg3zuwlqg',
                'user_id' => 3,
                'status' => 1,
                'created_at' => '2024-10-03 05:00:00',
                'updated_at' => '2024-10-03 05:30:00'
            ],
            [
                'title' => 'Cách phối đồ cho các buổi hẹn hò lãng mạn',
                'content' => 'Những cách phối đồ tinh tế giúp bạn ghi điểm trong mắt đối phương trong các buổi hẹn hò.',
                'thumbnail' => 'https://res.cloudinary.com/dkfedhd63/image/upload/f_auto,q_auto/pntxwsoguz8pyw0p5tmk',
                'user_id' => 1,
                'status' => 1,
                'created_at' => '2024-10-04 06:00:00',
                'updated_at' => '2024-10-04 06:20:00'
            ],
            [
                'title' => 'Làm thế nào để mặc đồ công sở mà vẫn thời trang?',
                'content' => 'Khám phá những bí quyết mặc đồ công sở vừa thanh lịch vừa phong cách.',
                'thumbnail' => 'https://res.cloudinary.com/dkfedhd63/image/upload/f_auto,q_auto/d6wmsxxsswti0vughm9v',
                'user_id' => 4,
                'status' => 1,
                'created_at' => '2024-10-05 07:00:00',
                'updated_at' => '2024-10-05 07:25:00'
            ],
            [
                'title' => 'Những kiểu tóc hợp với trang phục thể thao',
                'content' => 'Khám phá những kiểu tóc giúp bạn thêm phần năng động và thời trang khi diện trang phục thể thao.',
                'thumbnail' => 'https://res.cloudinary.com/dkfedhd63/image/upload/f_auto,q_auto/n5pfh10wpaosaxq8hf1s',
                'user_id' => 5,
                'status' => 1,
                'created_at' => '2024-10-06 08:00:00',
                'updated_at' => '2024-10-06 08:30:00'
            ],
            [
                'title' => 'Cách chăm sóc giày da để luôn mới',
                'content' => 'Những mẹo nhỏ giúp bạn chăm sóc và bảo vệ đôi giày da yêu thích luôn như mới.',
                'thumbnail' => 'https://res.cloudinary.com/dkfedhd63/image/upload/f_auto,q_auto/q6t0jwrqfieezlb4he4z',
                'user_id' => 6,
                'status' => 1,
                'created_at' => '2024-10-07 09:00:00',
                'updated_at' => '2024-10-07 09:15:00'
            ],
            [
                'title' => 'Xu hướng thời trang bền vững năm 2024',
                'content' => 'Tìm hiểu về xu hướng thời trang bền vững và cách bạn có thể tham gia vào phong trào này.',
                'thumbnail' => 'https://res.cloudinary.com/dkfedhd63/image/upload/f_auto,q_auto/ewz0wqjmyt0ihwxkhbo5',
                'user_id' => 2,
                'status' => 1,
                'created_at' => '2024-10-08 10:00:00',
                'updated_at' => '2024-10-08 10:20:00'
            ],
            [
                'title' => 'Cách lựa chọn túi xách phù hợp cho mỗi dịp',
                'content' => 'Khám phá những cách lựa chọn túi xách phù hợp cho các dịp khác nhau, từ dạo phố đến tiệc tối.',
                'thumbnail' => 'https://res.cloudinary.com/dkfedhd63/image/upload/f_auto,q_auto/uq5fhtrzdxrxnwg2vd5g',
                'user_id' => 3,
                'status' => 1,
                'created_at' => '2024-10-09 11:00:00',
                'updated_at' => '2024-10-09 11:30:00'
            ],
            [
                'title' => 'Cách phối đồ cho mùa đông lạnh giá',
                'content' => 'Những cách phối đồ giúp bạn giữ ấm mà vẫn thời trang trong mùa đông lạnh giá.',
                'thumbnail' => 'https://res.cloudinary.com/dkfedhd63/image/upload/f_auto,q_auto/jjmje76cbnxxdlrjocwe',
                'user_id' => 4,
                'status' => 1,
                'created_at' => '2024-10-10 12:00:00',
                'updated_at' => '2024-10-10 12:30:00'
            ],
            [
                'title' => 'Lựa chọn đồ thể thao cho người mới bắt đầu',
                'content' => 'Những gợi ý lựa chọn đồ thể thao phù hợp cho người mới bắt đầu tham gia tập luyện.',
                'thumbnail' => 'https://res.cloudinary.com/dkfedhd63/image/upload/f_auto,q_auto/tuoxcykqjx5ryahmjrn5',
                'user_id' => 5,
                'status' => 1,
                'created_at' => '2024-10-11 13:00:00',
                'updated_at' => '2024-10-11 13:30:00'
            ],
            [
                'title' => 'Lịch sử của các xu hướng thời trang nổi bật',
                'content' => 'Tìm hiểu về lịch sử và sự phát triển của các xu hướng thời trang nổi bật trong thập kỷ qua.',
                'thumbnail' => 'https://res.cloudinary.com/dkfedhd63/image/upload/f_auto,q_auto/lqj2zex0y7kmxhwusxmt',
                'user_id' => 6,
                'status' => 1,
                'created_at' => '2024-10-12 14:00:00',
                'updated_at' => '2024-10-12 14:30:00'
            ], [
                'title' => 'Bí quyết phối đồ đi làm mùa thu',
                'content' => 'Những mẹo phối đồ giúp bạn tự tin và chuyên nghiệp khi đi làm trong mùa thu.',
                'thumbnail' => 'https://res.cloudinary.com/dkfedhd63/image/upload/f_auto,q_auto/z7jqw1sxpht5p0ozuw3j',
                'user_id' => 7,
                'status' => 1,
                'created_at' => '2024-10-13 15:00:00',
                'updated_at' => '2024-10-13 15:30:00'
            ],
            [
                'title' => 'Cách chọn giày thể thao phù hợp cho từng bộ đồ',
                'content' => 'Tìm hiểu cách chọn giày thể thao giúp bạn nâng tầm bộ trang phục của mình.',
                'thumbnail' => 'https://res.cloudinary.com/dkfedhd63/image/upload/f_auto,q_auto/ctkkonkmrbzdqebcdpvl',
                'user_id' => 8,
                'status' => 1,
                'created_at' => '2024-10-14 16:00:00',
                'updated_at' => '2024-10-14 16:30:00'
            ],
            [
                'title' => 'Xu hướng thời trang cho người lớn tuổi',
                'content' => 'Khám phá xu hướng thời trang hiện đại và thoải mái dành cho người lớn tuổi.',
                'thumbnail' => 'https://res.cloudinary.com/dkfedhd63/image/upload/f_auto,q_auto/sdb7n6wb2qvlbws3rhq7',
                'user_id' => 9,
                'status' => 1,
                'created_at' => '2024-10-15 17:00:00',
                'updated_at' => '2024-10-15 17:20:00'
            ],
            [
                'title' => 'Phối đồ đẹp cho chuyến du lịch cuối tuần',
                'content' => 'Những gợi ý phối đồ cho chuyến du lịch cuối tuần thêm phần thú vị và phong cách.',
                'thumbnail' => 'https://res.cloudinary.com/dkfedhd63/image/upload/f_auto,q_auto/rcgb1bhd9jzlk8fdbi7x',
                'user_id' => 10,
                'status' => 1,
                'created_at' => '2024-10-16 18:00:00',
                'updated_at' => '2024-10-16 18:30:00'
            ],
            [
                'title' => 'Làm thế nào để chọn trang phục dạo phố mùa hè?',
                'content' => 'Những gợi ý để bạn có thể chọn trang phục dạo phố mùa hè vừa thoải mái vừa đẹp.',
                'thumbnail' => 'https://res.cloudinary.com/dkfedhd63/image/upload/f_auto,q_auto/bceasb1ub5ptmlvqxzid',
                'user_id' => 7,
                'status' => 1,
                'created_at' => '2024-10-17 19:00:00',
                'updated_at' => '2024-10-17 19:25:00'
            ],
            [
                'title' => 'Phối đồ với áo sơ mi công sở',
                'content' => 'Khám phá những cách phối đồ với áo sơ mi công sở giúp bạn thêm thanh lịch và nổi bật.',
                'thumbnail' => 'https://res.cloudinary.com/dkfedhd63/image/upload/f_auto,q_auto/k9vscx6pve8jby7nh7sz',
                'user_id' => 8,
                'status' => 1,
                'created_at' => '2024-10-18 20:00:00',
                'updated_at' => '2024-10-18 20:30:00'
            ],
            [
                'title' => 'Mẹo giữ gìn áo khoác da luôn mới',
                'content' => 'Tìm hiểu những cách chăm sóc áo khoác da giúp bảo vệ chất liệu và giữ độ bền lâu dài.',
                'thumbnail' => 'https://res.cloudinary.com/dkfedhd63/image/upload/f_auto,q_auto/bzltpmzpxdckfvnm6iwp',
                'user_id' => 9,
                'status' => 1,
                'created_at' => '2024-10-19 21:00:00',
                'updated_at' => '2024-10-19 21:15:00'
            ],
            [
                'title' => 'Chọn trang phục cho các buổi tiệc cuối năm',
                'content' => 'Cách chọn trang phục để bạn tỏa sáng trong các buổi tiệc cuối năm cùng bạn bè và gia đình.',
                'thumbnail' => 'https://res.cloudinary.com/dkfedhd63/image/upload/f_auto,q_auto/k8d2seknwmft9v7vnlyw',
                'user_id' => 10,
                'status' => 1,
                'created_at' => '2024-10-20 22:00:00',
                'updated_at' => '2024-10-20 22:30:00'
            ],
            [
                'title' => 'Lựa chọn phụ kiện đi kèm với trang phục mùa thu',
                'content' => 'Khám phá những phụ kiện phù hợp để tạo điểm nhấn cho trang phục mùa thu của bạn.',
                'thumbnail' => 'https://res.cloudinary.com/dkfedhd63/image/upload/f_auto,q_auto/zpftgzwcv6xeae6slwqg',
                'user_id' => 7,
                'status' => 1,
                'created_at' => '2024-10-21 23:00:00',
                'updated_at' => '2024-10-21 23:30:00'
            ],
            [
                'title' => 'Giày dép mùa đông không thể thiếu',
                'content' => 'Khám phá những đôi giày dép mùa đông giữ ấm mà vẫn thời trang cho bạn.',
                'thumbnail' => 'https://res.cloudinary.com/dkfedhd63/image/upload/f_auto,q_auto/ma4y3hws3zbyhxh2dpmj',
                'user_id' => 8,
                'status' => 1,
                'created_at' => '2024-10-22 00:00:00',
                'updated_at' => '2024-10-22 00:20:00'
            ]
        ]);
        
    }
}
