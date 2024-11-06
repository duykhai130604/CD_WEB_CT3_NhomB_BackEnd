<?php

namespace App\Http\Controllers;

use App\Models\ProductVariantModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

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

    public function deleteProductVariant(Request $request)
    {
        return ProductVariantModel::deleteProductVariant($request);
    }
    public function editProductVariant(Request $request)
    {
        return ProductVariantModel::editVariant($request);
    }
    public function getVariantByVariantId(Request $request)
    {
        return ProductVariantModel::getVariantByVariantId($request);
    }
    public function getProductVariants($id)
    {
        $decryptedId = Crypt::decrypt($id);
        $variants = ProductVariantModel::getProductVariants($decryptedId);
        if ($variants->isEmpty()) {
            return response()->json(['message' => 'No product variants found'], 404);
        }
        return response()->json($variants);
    }
}
