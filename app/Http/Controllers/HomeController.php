<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Crypt;

class HomeController extends Controller
{
    public function getTopProducts()
    {
        // Giả sử có một trường `sales` để xác định sản phẩm bán chạy
        $topProducts = Product::orderBy('created_at', 'desc')->take(10)->get();

        return response()->json($topProducts);
    }
}
