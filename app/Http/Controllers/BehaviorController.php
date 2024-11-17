<?php

namespace App\Http\Controllers;

use App\Models\Behavior;
use App\Models\Follow;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Tymon\JWTAuth\Facades\JWTAuth;

class BehaviorController extends Controller
{
    //
    public function follow(Request $request)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            return response()->json(['error' => 'User not authenticated'], 401);
        }
        try {
            $productId = Crypt::decrypt($request->productId);
            Behavior::trackProductFollow($user->id, $productId);
            $follow = Follow::follow($user->id, $productId);
            return response()->json([
                'message' => $follow ? 'Followed successfully!' : 'You are already following this product.',
                'follow' => $follow,
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while processing your request: ' . $e->getMessage()], 500);
        }
    }
    public function checkFollow(Request $request)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            return response()->json(['error' => 'User not authenticated'], 401);
        }
        $productId = Crypt::decrypt($request->product_id);
        $isFollowing = Follow::checkFollow($user->id, $productId);
        return response()->json([
            'isFollowing' => $isFollowing 
        ], 200);
    }
    public function getFollowedProducts(){
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            return response()->json(['error' => 'User not authenticated'], 401);
        }
        $isFollowing = Follow::getFollowedProducts($user->id,);
      return response()->json($isFollowing);
    }
}
