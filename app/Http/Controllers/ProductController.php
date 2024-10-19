<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function getAllProducts(Request $request)
    {
        $keyword = $request->input('keyword');
        $products = Product::getAllProducts($keyword);
        if ($products->isEmpty() && $keyword) {
            return response()->json(['message' => 'Product Not Found']);
        }

        return response()->json($products);
    }

    public function addProduct(Request $request)
    {
        $result = Product::addProduct($request);
        if ($result['status'] === 'error') {
            return response()->json([
                'errors' => $result['errors'] ?? $result['message']
            ], 422);
        }
        return response()->json([
            'message' => $result['message'],
            'product' => $result['product']
        ], 201);
    }
}
