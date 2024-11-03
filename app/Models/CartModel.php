<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;

class CartModel extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'carts';
    public function productVariant()
    {
        return $this->belongsTo(ProductVariantModel::class, 'product_variant_id');
    }
    public static function getUserCart()
    {
        $user = JWTAuth::parseToken()->authenticate();

        if (!$user) {
            return response()->json(['error' => 'User not authenticated'], 401);
        }

        $userId = $user->id;

        // Lấy các sản phẩm trong giỏ hàng của người dùng, tự động loại bỏ bản ghi đã xóa mềm
        $cartItems = CartModel::with(['productVariant.product', 'productVariant.size', 'productVariant.color'])
            ->where('user_id', $userId)
            ->get()
            ->map(function ($cart) {
                return [
                    'variant_quantity' => $cart->quantity,
                    'product_name' => $cart->productVariant->product->name ?? null,
                    'product_price' => $cart->productVariant->product->price ?? null,
                    'product_thumbnail' => $cart->productVariant->product->thumbnail ?? null,
                    'size_name' => $cart->productVariant->size->name ?? null,
                    'color_name' => $cart->productVariant->color->name ?? null,
                    'variant_id' => $cart->product_variant_id,
                ];
            });

        return response()->json(['cart' => $cartItems], 200);
    }


    public static function deleteItemFromCart($request)
    {
        $user = JWTAuth::parseToken()->authenticate();

        if (!$user) {
            return response()->json(['error' => 'User not authenticated'], 401);
        }

        $userId = $user->id;
        $variantId = $request->input('variant_id');

        if (!$variantId) {
            return response()->json(['error' => 'Variant ID is required'], 400);
        }

        // Sử dụng Eloquent Model để xóa mềm
        $deleted = CartModel::where('user_id', $userId)
            ->where('product_variant_id', $variantId)
            ->first();

        if ($deleted) {
            $deleted->delete(); // Gọi hàm delete() từ Eloquent Model
            return response()->json(['message' => 'Item removed from cart successfully'], 200);
        } else {
            return response()->json(['error' => 'Item not found in cart'], 404);
        }
    }
    public static function updateQuantityInCart($request)
    {
        $user = JWTAuth::parseToken()->authenticate();

        if (!$user) {
            return response()->json(['error' => 'User not authenticated'], 401);
        }

        $userId = $user->id;
        $variantId = $request->input('variant_id');
        $quantity = $request->input('quantity');

        if (!$variantId) {
            return response()->json(['error' => 'Variant ID is required'], 400);
        }

        if (!is_numeric($quantity) || $quantity <= 0) {
            return response()->json(['error' => 'Quantity must be a positive integer'], 400);
        }

        // Tìm sản phẩm trong giỏ hàng
        $cartItem = CartModel::where('user_id', $userId)
            ->where('product_variant_id', $variantId)
            ->first();

        if ($cartItem) {
            // Cập nhật số lượng sản phẩm
            $cartItem->quantity = $quantity;
            $cartItem->save(); // Lưu thay đổi

            return response()->json(['message' => 'Quantity updated successfully'], 200);
        } else {
            return response()->json(['error' => 'Item not found in cart'], 404);
        }
    }
}
