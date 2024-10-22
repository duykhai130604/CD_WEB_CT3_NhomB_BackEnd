<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\product_category;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getCategoriesByPage()
    {
        $categories = Category::getCategoriesByPage(10);
        return $categories;
    }

    public function getCategoryById($encryptedId)
    {
        try {
            $decryptedId = Crypt::decrypt($encryptedId);
            if (!is_numeric($decryptedId) || intval($decryptedId) <= 0) {
                return response()->json(['error' => 'Invalid ID format.'], 400);
            }
            $category = Category::getCategoryById($decryptedId);
            return response()->json($category);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            return response()->json(['error' => 'Invalid or corrupted ID.'], 400);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Category not found.'], 404);
        }
    }

    public function addCategory(Request $request)
    {
        $validatedData = $request->validate([
            'parent_id' => 'required|integer',
            'name' => 'required|string|max:255',
            'status' => 'required|integer'
        ]);
        $categoryCheck = Category::getCategoryByName($request->name);
        if ($categoryCheck) {
            return  response()->json(0, 200);
        } else {
            Category::addCategory($validatedData);
            return response()->json(1, 201);
        }
    }

    public function updateCategory(Request $request)
    {
        try {
            $decryptedId = Crypt::decrypt($request->id);
            if (!is_numeric($decryptedId) || intval($decryptedId) <= 0) {
                return response()->json(['error' => 'Invalid ID format.'], 400);
            }
            $validatedData = $request->validate([
                'parent_id' => 'required|integer',
                'name' => 'required|string|max:255',
                'status' => 'required|integer'
            ]);
            $categoryCheck = Category::getCategoryByName($request->name);
            if ($categoryCheck && $categoryCheck->id != $decryptedId) {
                return  response()->json(0, 200);
            } else {
                Category::updateCategory($decryptedId, $validatedData);
                return response()->json(1, 201);
            }
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            return response()->json(['error' => 'Invalid or corrupted ID.'], 400);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Category not found.'], 404);
        }
    }

    public function deleteCategory($encryptedId)
    {
        try {
            $decryptedId = Crypt::decrypt($encryptedId);
            if (!is_numeric($decryptedId) || intval($decryptedId) <= 0) {
                return response()->json(['error' => 'Invalid ID format.'], 400);
            }
            Category::deleteCategory($decryptedId);
            return response()->json(null, 204);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            return response()->json(['error' => 'Invalid or corrupted ID.'], 400);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Category not found.'], 404);
        }
    }

    public function changeCategory($encryptedId)
    {
        try {
            $decryptedId = Crypt::decrypt($encryptedId);
            if (!is_numeric($decryptedId) || intval($decryptedId) <= 0) {
                return response()->json(['error' => 'Invalid ID format.'], 400);
            }

            $category = Category::changeCategoryStatus($decryptedId, 0);
            return response()->json($category);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            return response()->json(['error' => 'Invalid or corrupted ID.'], 400);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Category not found.'], 404);
        }
    }

    public function getAllCategories()
    {
        $categories = Category::getAllCategories();
        return response()->json($categories);
    }
    public function getParentCategories(Request $request)
    {
        $ids = explode(',', $request->input('ids'));
        $categories = Category::getCategoriesByIds($ids);
        return response()->json($categories);
    }
    public function checkCategoryAssets(Request $request)
    {
        $cateId = $request->id;
        $categories = Category::getCategoryByParentId($cateId);
        $products = Product::getProductsByCategory($cateId);
        if ($categories) {
            return response()->json(['categories' => $categories, 'products' => $products], 201);
        }
        return response()->json(['message' => 'Category has no assets.'], 200);
    }
    public function getCategoryByParentId($encryptedId)
    {
        try {
            $decryptedId = Crypt::decrypt($encryptedId);
            if (!is_numeric($decryptedId) || intval($decryptedId) <= 0) {
                return response()->json(['error' => 'Invalid ID format.'], 400);
            }

            $category = Category::getCategoryByParentId($decryptedId);
            return response()->json($category);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            return response()->json(['error' => 'Invalid or corrupted ID.'], 400);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Category not found.'], 404);
        }
    }
    public function updateProductCategoryAndParent(Request $request)
{
    // Validate the incoming request
    $validatedData = $request->validate([
        'product_ids' => 'nullable|array',           // Array of product IDs
        'old_category_id' => 'required|integer',     // Old category ID
        'new_category_id' => 'required|integer',     // New category ID
        'category_ids' => 'nullable|array',          // Array of category IDs to update parent
    ]);

    $productIds = $validatedData['product_ids'];
    $oldCategoryId = $validatedData['old_category_id'];
    $newCategoryId = $validatedData['new_category_id'];
    $categoryIds = $validatedData['category_ids'];

    $productCategory = new product_category();

    $productCategory->deleteProductCategory($productIds, $oldCategoryId);

    $productCategory->addProductCategory($productIds, $newCategoryId);

     Category::editParent($categoryIds, $newCategoryId);

    return response()->json(['message' => 'Product categories and parent categories updated successfully']);
}

}
