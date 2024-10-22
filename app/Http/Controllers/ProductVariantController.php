<?php

namespace App\Http\Controllers;

use App\Models\ProductVariantModel;
use Illuminate\Http\Request;

class ProductVariantController extends Controller
{
    //
    public function getAllProductVariants(Request $request)
    {
        return ProductVariantModel::getAllVariantsByProductId($request);
    }

}
