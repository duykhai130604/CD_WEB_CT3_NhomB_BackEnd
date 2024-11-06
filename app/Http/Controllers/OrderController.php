<?php

namespace App\Http\Controllers;
use App\Models\OrderModel;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class OrderController extends Controller
{
    //
    public function getOrdersByUser() {
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
            return response()->json(['error'=>$e->getMessage()]);
    }
}}
