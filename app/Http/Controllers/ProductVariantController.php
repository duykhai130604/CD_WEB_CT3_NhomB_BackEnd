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

    public function addProductVariant(Request $request)
    {
        return ProductVariantModel::addProductVariantWithImages($request);
    }

    public function deleteProductVariant(Request $request){
        return ProductVariantModel::deleteProductVariantWithImages($request);
    }

}
