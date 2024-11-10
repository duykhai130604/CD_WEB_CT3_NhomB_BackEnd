<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOrder extends Model
{
    use HasFactory;
    protected $table = 'product_order';
    protected $fillable = [
        'product_variant_id', 'order_id', 'quantity', 'total', 'rate'
    ];
    public static function updateRate($productVariantId, $orderId, $newRate = 1)
    {
        return self::where('product_variant_id', $productVariantId)
                    ->where('order_id', $orderId)
                    ->update(['rate' => $newRate]);
    }
}
