<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProductOrder extends Model
{
    use HasFactory;
    protected $table = 'product_order';
    protected $fillable = [
        'product_variant_id',
        'order_id',
        'quantity',
        'total',
        'rate'
    ];
    public static function updateRate($productVariantId, $orderId, $newRate = 1)
    {
        return self::where('product_variant_id', $productVariantId)
            ->where('order_id', $orderId)
            ->update(['rate' => $newRate]);
    }
    public static function updateStatusAndReason($id, $status, $reason)
    {
        $validStatuses = [0, 1, 2, 3, 4];
        if (!in_array($status, $validStatuses)) {
            return false;
        }
        $productOrder = self::find($id);

        if (!$productOrder) {
            return false;
        }
        $productOrder->status = $status;
        $productOrder->reason = $reason;
        return $productOrder->save();
    }
    public static function getMonthlyOrderStats($year)
    {
        return DB::table('product_order')
            ->select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('COUNT(*) as total_orders'),
                DB::raw('SUM(CASE WHEN status IN (2, 0) THEN 1 ELSE 0 END) as status_2_orders')
            )
            ->whereYear('created_at', $year)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy(DB::raw('MONTH(created_at)'))
            ->get();
    }

    public static function getMonthlyReasonStats($month, $year)
    {
        return DB::table('product_order')
            ->select(
                'reason',
                DB::raw('COUNT(*) as reason_count')
            )
            ->whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->whereIn('status', [2, 0])
            ->groupBy('reason')
            ->orderByDesc(DB::raw('COUNT(*)'))
            ->paginate(5);
    }
    public static function getProductStats($month, $year)
{
    return DB::table('product_order')
    ->join('product_variants', 'product_order.product_variant_id', '=', 'product_variants.id')
    ->join('products', 'product_variants.product_id', '=', 'products.id')
    ->select(
        'products.name',
        'product_order.reason as reason',
        'product_order.created_at as created_at',
        DB::raw('COUNT(product_order.id) as product_count')
    )
    ->whereYear('product_order.created_at', $year)
    ->whereMonth('product_order.created_at', $month)
    ->whereIn('product_order.status', [2, 0])
    ->groupBy('products.name', 'product_order.reason', 'product_order.created_at')
    ->orderBy('product_count', 'desc')
    ->paginate(5);

}

}
