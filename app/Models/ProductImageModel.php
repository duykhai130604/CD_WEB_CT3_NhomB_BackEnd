<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProductImageModel extends Model
{
    use HasFactory;
    protected $table = 'product_images';
    // Hàm thêm ảnh sản phẩm
    public static function addProductImage($variantId, $uploadedImage)
    {
        try {
            DB::table('product_images')->insert([
                'variant_id' => $variantId,
                'url' => $uploadedImage['secure_url'],
                'public_id' => $uploadedImage['public_id'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            return ['status' => 'success'];
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => 'Failed to add product image.'];
        }
    }
    public static function getImagesByVariantId($variantId)
    {
        // Lấy tất cả các hình ảnh của biến thể theo ID
        return DB::table('product_images')
            ->where('variant_id', $variantId)
            ->select('public_id')
            ->get();
    }
    public static function deleteImagesByVariantId($variantId)
    {
        // Xóa các hình ảnh theo ID biến thể
        return DB::table('product_images')
            ->where('variant_id', $variantId)
            ->delete();
    }
}
