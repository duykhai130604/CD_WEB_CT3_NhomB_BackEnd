<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProductCategory extends Model
{
    use HasFactory;
    protected $table = 'product_category';

    public static function addProductCategories($productId, $categories)
    {
        try {
            foreach ($categories as $categoryId) {
                DB::table('product_category')->insert([
                    'product_id' => $productId,
                    'category_id' => $categoryId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'System error, please try again later'
            ], 500);
        }
    }

    public static function updateProductCategories($productId, $categories)
    {
        try {
            // Xóa tất cả danh mục hiện tại của sản phẩm
            DB::table('product_category')->where('product_id', $productId)->delete();

            // Thêm lại các danh mục mới
            foreach ($categories as $categoryId) {
                DB::table('product_category')->insert([
                    'product_id' => $productId,
                    'category_id' => $categoryId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'System error, please try again later'
            ], 500);
        }
    }
    public static function getProductCategories($request)
    {
        $productId = EncryptionModel::decodeProductId($request->encodeId);
        try {
            $categories = DB::table('product_category')
                ->where('product_id', $productId)
                ->join('categories', 'product_category.category_id', '=', 'categories.id')
                ->select('categories.id')
                ->get();
            $ids = $categories->isEmpty() ? [] : $categories->pluck('id')->toArray();
            return response()->json([
                'status' => 'Success',
                'selectedCategories' => $ids
            ], 200, [],JSON_UNESCAPED_SLASHES);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'System error, please try again later'
            ], 500);
        }
    }
}
