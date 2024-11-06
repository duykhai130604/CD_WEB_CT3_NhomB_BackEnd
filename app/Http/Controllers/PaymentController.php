<?php

namespace App\Http\Controllers;

use App\Models\CartModel;
use App\Models\OrderModel;
use App\Models\Product;
use App\Models\ProductOrderModel;
use App\Models\ProductVariantModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class PaymentController extends Controller
{
    public function checkout(Request $request)
    {
        // 1. Lấy thông tin người dùng từ JWT
        try {
            $user = JWTAuth::parseToken()->authenticate();
            $userId = $user->id;
        } catch (JWTException $e) {
            return response()->json(['message' => 'Token không hợp lệ hoặc đã hết hạn.'], 401);
        }

        // 2. Kiểm tra giỏ hàng
        $carts = CartModel::where('user_id', $userId)->get();
        if ($carts->isEmpty()) {
            return response()->json(['message' => 'Giỏ hàng trống.'], 400);
        }

        // 3. Kiểm tra đầu vào
        $request->validate([
            'phone' => 'required|string|max:10',
            'address' => 'required|string|max:255',
        ]);

        // 4. Tính tổng số tiền cần thanh toán
        $totalAmount = 0;
        foreach ($carts as $cart) {
            try {
                $totalAmount += $cart->quantity * $this->getProductPrice($cart->product_variant_id);
            } catch (\Exception $e) {
                return response()->json(['message' => $e->getMessage()], 400);
            }
        }

        // 5. Sử dụng transaction để đảm bảo tính nhất quán của dữ liệu
        DB::beginTransaction();
        try {
            $order = OrderModel::create([
                'user_id' => $userId,
                'amount' => $totalAmount,
                'phone' => $request->input('phone'),
                'address' => $request->input('address'),
                'status' => 1,
            ]);

            foreach ($carts as $cart) {
                ProductOrderModel::create([
                    'product_variant_id' => $cart->product_variant_id,
                    'order_id' => $order->id,
                    'quantity' => $cart->quantity,
                ]);
            }

            // 5.3. Xóa giỏ hàng
            CartModel::where('user_id', $userId)->delete();

            // Hoàn thành transaction
            DB::commit();

            return response()->json(['message' => 'Thanh toán thành công!', 'order_id' => $order->id], 200);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Đã xảy ra lỗi trong quá trình thanh toán. Vui lòng thử lại sau. ' . $e->getMessage()], 500);
        }
    }

    public function getProductPrice($productVariantId): int
    {
        $productVariant = ProductVariantModel::find($productVariantId);

        if (!$productVariant) {
            throw new \Exception("Không tìm thấy product_variant với ID: $productVariantId");
        }

        $product = Product::find($productVariant->product_id);

        if (!$product) {
            throw new \Exception("Không tìm thấy sản phẩm gốc với ID: {$productVariant->product_id}");
        }

        $originalPrice = $product->price;
        $discount = $product->discount;
        $finalPrice = $originalPrice - ($originalPrice * ($discount / 100));

        return (int) $finalPrice;
    }
}
