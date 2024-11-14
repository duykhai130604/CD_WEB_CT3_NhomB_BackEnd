<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Crypt;

class HomeController extends Controller
{
    public function getTopProducts()
    {
        $topProducts = Product::getNewProducts();

        return response()->json($topProducts);
    }
    public function getProductByRatingRange(Request $request)
    {
        $products = Product::getProductsByRatingRange($request->rating);
        return response()->json($products);
    }
}
