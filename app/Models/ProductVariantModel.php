<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariantModel extends Model
{
    use HasFactory;
    protected $table = 'product_variants';
    public static function getAllVariantsByProductId($request)
    {
        $encodedId = $request->input('encodedId');
        $productId = EncryptionModel::decodeProductId($encodedId);
        $product = Product::find($productId);
        if (!$product) {
            return response()->json(['status' => 'error', 'message' => 'Product not found'], 404);
        }
        $variantsQuery = ProductVariantModel::where('product_id', $productId);
        $variants = $variantsQuery->orderBy('updated_at', 'desc')->paginate(10);
        if ($variants->isEmpty()) {
            return response()->json(['status' => 'success', 'message' => 'No Variants Found'], 200);
        }
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
        $variants->setCollection($responseData);
        return response()->json([
            'status' => 'success',
            'variants' => $variants,
        ]);
    }
}
