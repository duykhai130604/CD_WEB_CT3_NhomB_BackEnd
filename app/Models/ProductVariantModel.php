<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariantModel extends Model
{
    use HasFactory;
    protected $table = 'product_variants';
    /**
     * Giải mã ID sản phẩm từ chuỗi đã mã hóa.
     *
     * @param string $encodedId
     * @return string|null
     */
    public static function decodeProductId($encodedId)
    {
        $secretString = env('PRODUCT_SECRET_STRING');
        $decodedId = base64_decode($encodedId, true);
        if ($decodedId === false || strpos($decodedId, $secretString) === false) {
            return null;
        }
        $productId = str_replace($secretString, '', $decodedId);
        if (!is_numeric($productId)) {
            return null;
        }
        return $productId;
    }
    public static function getAllVariantsByProductId($request)
    {
        // Giải mã ID sản phẩm từ tham số request
        $encodedId = $request->input('encodedId');
        $productId = self::decodeProductId($encodedId);

        // Kiểm tra xem sản phẩm có tồn tại không
        $product = Product::find($productId);
        if (!$product) {
            return response()->json(['status' => 'error', 'message' => 'Product not found'], 404);
        }

        // Lấy tất cả variants của sản phẩm theo product_id
        $variantsQuery = ProductVariantModel::where('product_id', $productId);
        $variants = $variantsQuery->orderBy('updated_at', 'desc')->paginate(10);

        // Nếu không có variants nào
        if ($variants->isEmpty()) {
            return response()->json(['status' => 'success', 'message' => 'No Variants Found'], 200);
        }

        // Mã hóa ID variant
        $secretString = env('PRODUCT_SECRET_STRING');
        $responseData = $variants->getCollection()->map(function ($variant) use ($secretString) {
            return [
                'id' => base64_encode($variant->id . $secretString),
                'product_id' => $variant->product_id,
                'color_id' => $variant->color_id,
                'size_id' => $variant->size_id,
                'quantity' => $variant->quantity,
                'status' => $variant->status,
                'created_at' => $variant->created_at,
                'updated_at' => $variant->updated_at,
            ];
        });

        // Thay thế collection cũ bằng collection mới đã mã hóa
        $variants->setCollection($responseData);

        // Trả về dữ liệu với status
        return response()->json([
            'status' => 'success',
            'variants' => $variants,
        ]);
    }
}
