<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function getAllProducts(Request $request)
    {
        $keyword = $request->input('keyword'); // Thay đổi từ search thành keyword
        $productsQuery = Product::query();

        // Nếu có từ khóa tìm kiếm, áp dụng điều kiện tìm kiếm
        if ($keyword) {
            $productsQuery->where('name', 'like', '%' . $keyword . '%');
        }

        // Sắp xếp theo updated_at và phân trang
        $products = $productsQuery->orderBy('updated_at', 'desc')->paginate(2);

        // Kiểm tra nếu không có sản phẩm nào
        if ($products->isEmpty() && $keyword) {
            return response()->json(['message' => 'Product Not Found']);
        }

        return response()->json($products);
    }
}
