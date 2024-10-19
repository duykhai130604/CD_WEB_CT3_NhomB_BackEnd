<?php
namespace App\Http\Controllers;

use App\Models\Category;
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
        $category = Category::addCategory($validatedData);
        return response()->json($category, 201);
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
            $category = Category::updateCategory($decryptedId, $validatedData);
            return response()->json($category);
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
}