<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

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
    
    public function deleteProduct(Request $request) {
        return Product::destroy($request);
    }
    public function getProductByCategoryId($cateId){
        $decryptedId = Crypt::decrypt($cateId);
        $products = Product::getProductsByCategory($decryptedId);
        if($products){
            return response()->json($products, 200);
        }
        return response()->json(['message' => 'Product Not Found.'], 404);
    }
    public function getTopProducts()
    {
        $topProducts = Product::getTopProducts();
        return response()->json($topProducts);
    }
}
