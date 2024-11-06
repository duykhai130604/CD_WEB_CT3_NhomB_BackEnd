<?php

namespace App\Http\Controllers;

use App\Models\Behavior;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class ProductController extends Controller
{
    public function getAllProducts(Request $request)
    {
        return Product::getAllProducts($request);
    }

    public function getProductDetails(Request $request)
    {
        return Product::getProductDetails($request);
    }

    public function addProduct(Request $request)
    {
        return Product::addProduct($request);
    }

    public function editProduct(Request $request)
    {
        return Product::editProduct($request);
    }


    public function deleteProduct(Request $request)
    {
        return Product::destroy($request);
    }

    public function checkProduct(Request $request)
    {
        return Product::checkProduct($request);
    }
    public function getProductByCategoryId($cateId)
    {
        $decryptedId = Crypt::decrypt($cateId);
        $products = Product::getProductsByCategory($decryptedId);
        if ($products) {
            return response()->json($products, 200);
        }
        return response()->json(['message' => 'Product Not Found.'], 404);
    }
    public function getTopProducts()
    {
        $topProducts = Product::getTopProducts();
        return response()->json($topProducts);
    }
    public function getTopProductsByUser()
    {
         try {
            // Lấy thông tin người dùng từ JWT
            $user = JWTAuth::parseToken()->authenticate();
            if (!$user) {
                return response()->json(['error' => 'User not authenticated'], 401);
            }
            $userId = $user->id;
            $topProducts = Product::getTopProductsByUserNotInteracted($userId);
            return response()->json($topProducts);
         } catch (\Exception $e) {
         // Bắt lỗi nếu token không hợp lệ hoặc có lỗi khác
             return response()->json(['error' => 'Token is invalid or expired'], 401);
     }
    }
    public function getTopProductsByUserInteracted()
    {
        try {
            // Lấy thông tin người dùng từ JWT
            $user = JWTAuth::parseToken()->authenticate();
            if (!$user) {
                return response()->json(['error' => 'User not authenticated'], 401);
            }
            $userId = $user->id;
            $topProducts = Product::getTopProductsByUserInteracted($userId);
            return response()->json($topProducts);
        } catch (\Exception $e) {
            // Bắt lỗi nếu token không hợp lệ hoặc có lỗi khác
            return response()->json(['error' => 'Token is invalid or expired'], 401);
        }
    }
    // Hàm lấy sản phẩm theo tên và danh mục tương tự
    public function getProductsBySimilarNameAndCategory($id)
    {
        $decryptedId = Crypt::decrypt($id);
        if (!is_numeric($decryptedId) || intval($decryptedId) <= 0) {
            return response()->json(['error' => 'Invalid ID format.'], 400);
        }
        $products = Product::getProductsBySimilarNameAndCategory($decryptedId);

        return response()->json($products,);
    }    
    public function getProductbyID($id)
    {
        // Giải mã ID đã mã hóa
        $decryptedId = Crypt::decrypt($id);
        
        // Lấy sản phẩm từ model
        $productModel = new Product();
        $product = $productModel->getProductById($decryptedId);
        
        // Kiểm tra nếu sản phẩm không tồn tại
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
    
        // Kiểm tra nếu có JWT token, nếu không thì gán user là null
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            $user = null;
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            $user = null;
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            $user = null;
        }
    
        if (!$user) {
            Behavior::trackProductClick($product->id, null); // Không có user
        } else {
            Behavior::trackProductClick($product->id, $user->id); // Có user
        }
    
        // Trả về sản phẩm
        return response()->json($product, 200);
    }
    
}
