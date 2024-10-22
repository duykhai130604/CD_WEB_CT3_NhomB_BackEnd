<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

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
}
