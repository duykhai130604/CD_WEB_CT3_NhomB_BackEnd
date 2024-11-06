<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
/* 
1: Đã giao thành công
0: Bị hủy bởi admin
2: bị hủy bởi khác hàng
3: đang chuyển xử lí
4: thanh toán hoặc hóa trình xử lí không thành công
*/
class OrderModel extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $fillable = [
        'user_id',
        'amount',
        'phone',
        'address',
        'status',
    ];
      public function getProductOrdersWithVariants($userId)
        {
            return DB::table('product_order as po')
                ->join('orders as o', 'po.order_id', '=', 'o.id')
                ->join('users as u', 'u.id', '=', 'o.user_id')
                ->join('product_variants as pv', 'pv.id', '=', 'po.product_variant_id')
                ->join('product_images as pi', 'pi.variant_id', '=', 'pv.id')
                ->where('u.id', $userId)
                ->select('pv.*','pi.url as img')
                ->get();
        
    }
}
