<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getAllProducts(Request $request)
    {
        $keyword = $request->input('keyword');
        return Product::getAllProducts($keyword);
    }

    public function addProduct(Request $request)
    {
        return Product::addProduct($request);
    }
    public function editProduct(Request $request)
    {
        return Product::editProduct($request);
    }
    public function getProductDetails(Request $request)
    {
        $encodedId = $request->input('encodedId');
        return Product::getProductDetails($encodedId);
    }
}
