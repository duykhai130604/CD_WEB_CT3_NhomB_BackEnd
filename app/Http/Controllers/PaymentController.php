<?php

namespace App\Http\Controllers;

use App\Models\CartModel;
use App\Models\OrderModel;
use App\Models\Product;
use App\Models\ProductOrderModel;
use App\Models\ProductVariantModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class PaymentController extends Controller
{
    public function checkout(Request $request)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
            $userId = $user->id;
        } catch (JWTException $e) {
            return response()->json(['message' => 'Token không hợp lệ hoặc đã hết hạn.'], 401);
        }

        // 1. Lấy tất cả sản phẩm trong giỏ hàng của người dùng
        $carts = CartModel::where('user_id', $userId)->get();
        if ($carts->isEmpty()) {
            return response()->json(['message' => 'Giỏ hàng trống.'], 400);
        }

        // 2. Kiểm tra dữ liệu đầu vào
        $request->validate([
            'phone' => 'required|string|max:10',
            'address' => 'required|string|max:255',
        ]);

        // 3. Kiểm tra tồn kho trước khi tính toán tiền
        foreach ($carts as $cart) {
            $productVariant = ProductVariantModel::find($cart->product_variant_id);
            if ($productVariant && $productVariant->quantity < $cart->quantity) {
                return response()->json([
                    'message' => "Số lượng sản phẩm {$productVariant->product->name} không đủ trong kho. Chỉ còn {$productVariant->quantity} sản phẩm.",
                ], 400);
            }
        }

        // 4. Tính tổng số tiền
        $totalAmount = 0;
        foreach ($carts as $cart) {
            try {
                $totalAmount += $cart->quantity * $this->getProductPrice($cart->product_variant_id);
            } catch (\Exception $e) {
                return response()->json(['message' => $e->getMessage()], 400);
            }
        }

        // 5. Bắt đầu transaction
        DB::beginTransaction();
        try {
            $order = OrderModel::create([
                'user_id' => $userId,
                'amount' => $totalAmount,
                'phone' => $request->input('phone'),
                'address' => $request->input('address'),
                'status' => 1,
                'rate' => 0,
            ]);

            // Tạo đơn hàng liên quan đến từng sản phẩm trong giỏ
            foreach ($carts as $cart) {
                ProductOrderModel::create([
                    'product_variant_id' => $cart->product_variant_id,
                    'order_id' => $order->id,
                    'quantity' => $cart->quantity,
                ]);
            }

            // 6. Kiểm tra lại tồn kho trước khi giảm số lượng
            foreach ($carts as $cart) {
                $productVariant = ProductVariantModel::find($cart->product_variant_id);
                if ($productVariant && $productVariant->quantity < $cart->quantity) {
                    // Nếu kho không đủ, rollback giao dịch
                    DB::rollBack();
                    return response()->json([
                        'message' => "Số lượng sản phẩm {$productVariant->product->name} không đủ trong kho. Chỉ còn {$productVariant->quantity} sản phẩm.",
                    ], 400);
                }
            }

            // Gọi MoMo API để thực hiện thanh toán
            $paymentRequest = new Request([
                'orderInfo' => "Thanh toán đơn hàng #{$order->id}",
                'amount' => $totalAmount,
                'redirectUrl' => 'http://localhost:8080/',
                'ipnUrl' => 'http://localhost:8080/',
                'extraData' => 'hi',
            ]);

            $paymentResponse = $this->createPayment($paymentRequest);
            $paymentResponseData = $paymentResponse->getData();

            // Kiểm tra kết quả thanh toán và commit transaction
            if (isset($paymentResponseData->payUrl)) {
                DB::commit();

                // Giảm số lượng tồn kho sau khi thanh toán thành công
                foreach ($carts as $cart) {
                    $productVariant = ProductVariantModel::find($cart->product_variant_id);
                    if ($productVariant) {
                        // Giảm số lượng trong kho
                        $productVariant->quantity -= $cart->quantity;
                        // Lưu lại thay đổi
                        $productVariant->save();
                    }
                }

                // Xóa giỏ hàng của người dùng sau khi thanh toán thành công
                CartModel::where('user_id', $userId)->delete();

                return response()->json([
                    'message' => 'Tạo đơn hàng thành công!',
                    'payment_url' => $paymentResponseData->payUrl
                ], 200);
            } else {
                DB::rollBack();
                return response()->json(['message' => 'Thanh toán không thành công. Vui lòng thử lại.'], 500);
            }
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
    public function createPayment(Request $request)
    {
        // ENV
        $partnerCode = env('MOMO_PARTNER_CODE');
        $accessKey = env('MOMO_ACCESS_KEY');
        $secretKey = env('MOMO_SECRET_KEY');
        $endpoint = env('MOMO_ENDPOINT');

        // Request
        $orderId = time() . '';
        $orderInfo = $request->orderInfo;
        $amount = $request->amount;
        $redirectUrl = $request->redirectUrl;
        $ipnUrl = $request->ipnUrl;
        $extraData = $request->extraData;

        $requestId = time() . "";
        $requestType = "payWithATM";

        // Tạo hash để bảo mật yêu cầu
        $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
        $signature = hash_hmac("sha256", $rawHash,  $secretKey);

        $data = [
            'partnerCode' => $partnerCode,
            'partnerName' => "Test",
            'storeId' => "MomoTestStore",
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl' => $ipnUrl,
            'lang' => 'vi',
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature
        ];

        // POST -> Momo API
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post($endpoint, $data);

        // Return URL
        $jsonResult = $response->json();
        return response()->json($jsonResult);
    }
}
