<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    //
    public function getCategoriesByProductId(Request $request) {
        return ProductCategory::getProductCategories($request);
    }
}
