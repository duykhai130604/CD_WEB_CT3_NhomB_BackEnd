<?php

namespace App\Http\Controllers;

use App\Models\OrderModel;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
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
    public function getTotalUsers()
    {
        return User::countUsers();
    }
    public function calculateTotalAmount()
    {
        return OrderModel::calculateTotalAmount();
    }
    public function countOrders()
    {
        return OrderModel::countOrders();
    }
}
