<?php

namespace App\Http\Controllers;

use App\Models\OrderModel;
use App\Models\Product;
use App\Models\ProductOrder;
use App\Models\ReviewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Tymon\JWTAuth\Facades\JWTAuth;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $enProduct = Crypt::decrypt($request->product_id);
        $enVariant = Crypt::decrypt($request->variant);
        $enOrder = Crypt::decrypt($request->order);
        $user = JWTAuth::parseToken()->authenticate();   
             if (!$user) {
            return response()->json([
                'message' => 'User not authenticated'
            ], 401); 
        }
        $data = [
            'content' => $request->content,
            'rating' => $request->rating,
            'user_id' => $user->id,
            'variant' => $enVariant,
            'product_id' => $enProduct,
        ];
        try {
            $reviewModel = new ReviewModel();
            $review = $reviewModel->store((object) $data);
            ProductOrder::updateRate($enVariant,$enOrder);
            return response()->json($review, 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to create review',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
