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

        $cartItems = CartModel::with(['productVariant.size', 'productVariant.color'])
            ->where('user_id', $userId)
            ->whereHas('productVariant.product', function ($query) {
                $query->whereNull('deleted_at');
            })
            ->orderBy('created_at', 'desc')
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

        $deleted = CartModel::where('user_id', $userId)
            ->where('product_variant_id', $variantId)
            ->first();

        if ($deleted) {
            $deleted->delete();
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

        // Kiểm tra số lượng tồn kho trong product_variant
        $productVariant = ProductVariantModel::find($variantId);

        if (!$productVariant) {
            return response()->json(['error' => 'Product variant not found'], 404);
        }

        if ($quantity > $productVariant->quantity) {
            return response()->json([
                'error' => 'Requested quantity exceeds available stock',
            ], 400);
        }

        $cartItem = CartModel::where('user_id', $userId)
            ->where('product_variant_id', $variantId)
            ->first();

        if ($cartItem) {
            $cartItem->quantity = $quantity;
            $cartItem->save();
            return response()->json(['message' => 'Quantity updated successfully'], 200);
        } else {
            return response()->json(['error' => 'Item not found in cart'], 404);
        }
    }
}
