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
        'rate',
    ];
    public function getProductOrdersWithVariants($userId)
    {
        return DB::table('product_order as po')
            ->join('orders as o', 'po.order_id', '=', 'o.id')
            ->join('users as u', 'u.id', '=', 'o.user_id')
            ->join('product_variants as pv', 'pv.id', '=', 'po.product_variant_id')
            ->join('product_images as pi', 'pi.variant_id', '=', 'pv.id')
            ->join('products as p', 'p.id', '=', 'pv.product_id')
            ->join('sizes as s', 'pv.size_id', '=', 's.id')
            ->join('colors as c', 'pv.color_id', '=', 'c.id')
            ->where('u.id', $userId)
            ->select('po.id as id','p.name as name', 'p.thumbnail', 'po.total', 's.name as size', 'c.name as color', 'po.quantity', 'po.rate', 'o.id as order', 'p.id as product', 'pv.id as variant', 'po.created_at as created_at','po.status as status')
            ->orderBy('po.created_at', 'desc')->paginate(10);
    }
    public static function getOrderDetails()
    {
        return self::select(
            'product_order.id as id',
            'product_order.created_at as created_at',
            'orders.user_id',
            'orders.amount',
            'orders.phone',
            'orders.address',
            'product_order.status as status',
            'product_order.updated_at as cancle',
            'orders.rate',
            'orders.created_at as order_created_at',
            'product_order.product_variant_id',
            'product_order.quantity',
            'product_order.total',
            'product_order.reason',
            'product_order.rate as product_order_rate',
            'product_variants.id as product_variant_id',
            'product_variants.product_id',
            'products.id as product_id',
            'products.name as product_name',
            'products.price as product_price',
            'sizes.name as size',
            'colors.name as color',
            'users.name as user',
            'orders.phone as phone',
        )
            ->join('product_order', 'orders.id', '=', 'product_order.order_id')
            ->join('product_variants', 'product_order.product_variant_id', '=', 'product_variants.id')
            ->join('products', 'product_variants.product_id', '=', 'products.id')
            ->join('sizes', 'sizes.id', '=', 'product_variants.size_id')
            ->join('colors', 'colors.id', '=', 'product_variants.color_id')
            ->join('users', 'users.id', '=', 'orders.user_id')
            ->orderBy('product_order.created_at', 'desc')
            ->paginate(100);
    }
    public static function getOrderDetailsByDate($date)
    {
        return self::select(
            'product_order.id as id',
            'product_order.created_at as created_at',
            'orders.user_id',
            'orders.amount',
            'orders.phone',
            'orders.address',
            'product_order.status as status',
            'product_order.updated_at as cancle',
            'orders.rate',
            'orders.created_at as order_created_at',
            'product_order.product_variant_id',
            'product_order.quantity',
            'product_order.total',
            'product_order.reason',
            'product_order.rate as product_order_rate',
            'product_variants.id as product_variant_id',
            'product_variants.product_id',
            'products.id as product_id',
            'products.name as product_name',
            'products.price as product_price',
            'sizes.name as size',
            'colors.name as color',
            'users.name as user',
            'orders.phone as phone',
        )
            ->join('product_order', 'orders.id', '=', 'product_order.order_id')
            ->join('product_variants', 'product_order.product_variant_id', '=', 'product_variants.id')
            ->join('products', 'product_variants.product_id', '=', 'products.id')
            ->join('sizes', 'sizes.id', '=', 'product_variants.size_id')
            ->join('colors', 'colors.id', '=', 'product_variants.color_id')
            ->join('users', 'users.id', '=', 'orders.user_id')
            ->whereDate('product_order.created_at', $date)
            ->orderBy('orders.created_at', 'desc')
            ->paginate(100); 
    }

    public static function calculateTotalAmount()
    {
        $totalAmount = DB::table('orders')->sum('amount');

        return response()->json([
            'message' => 'Total amount calculated successfully',
            'total_amount' => $totalAmount
        ]);
    }
    public static function countOrders()
    {
        $orderCount = DB::table('orders')->count();

        return response()->json([
            'message' => 'Total orders retrieved successfully',
            'total_orders' => $orderCount
        ]);
    }
}
