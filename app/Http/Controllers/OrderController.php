<?php

namespace App\Http\Controllers;

use App\Models\OrderModel;
use App\Models\ProductOrder;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class OrderController extends Controller
{
    //
    public function getOrdersByUser()
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
            if (!$user) {
                return response()->json(['error' => 'User not authenticated'], 401);
            }
            $userId = $user->id;
            $orderModel = new OrderModel();
            $orders = $orderModel->getProductOrdersWithVariants($userId);
            return response()->json($orders);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
    public function getOrders()
    {
        $orders = OrderModel::getOrderDetails();
        return response()->json($orders);
    }
    public function getOrdersByDate($date)
    {
        $orders = OrderModel::getOrderDetailsByDate($date);
        return response()->json($orders);
    }
    public function updateStatus( Request $request)
    {
     
        $updated = ProductOrder::updateStatusAndReason($request->id, $request->status, $request->reason);

        if (!$updated) {
            return response()->json(['message' => 'Product order not found or invalid status'], 404);
        }

        return response()->json(['message' => 'Product order updated successfully'], 200);
    }
    
}
