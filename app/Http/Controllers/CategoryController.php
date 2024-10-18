<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getCategoriesByPage()
    {
        $categories = Category::paginate(10);
        return response()->json($categories);
    }
    public function getCategoryById($encryptedId)
    {
        try {
            $decryptedId = Crypt::decrypt($encryptedId);
            if (!is_numeric($decryptedId) || intval($decryptedId) <= 0) {
                return response()->json(['error' => 'Invalid ID format.'], 400);
            }
            $category = Category::findOrFail($decryptedId);
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
        $category = Category::create($validatedData);
        return response()->json($category, 201);
    }
    public function updateCategory(Request $request)
    {
        try {
            $decryptedId = Crypt::decrypt($request->id);
            if (!is_numeric($decryptedId) || intval($decryptedId) <= 0) {
                return response()->json(['error' => 'Invalid ID format.'], 400);
            }
            $category = Category::findOrFail($decryptedId);
            $validatedData = $request->validate([
                'parent_id' => 'required|integer',
                'name' => 'required|string|max:255',
                'status' => 'required|integer'
            ]);
            $category->update($validatedData);
            return response()->json($category);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            return response()->json(['error' => 'Invalid or corrupted ID.'], 400);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error Category not found.'], 404);
        }
    }
    public function deleteCategory($encryptedId){
        try {
            $decryptedId = Crypt::decrypt($encryptedId);
            if (!is_numeric($decryptedId) || intval($decryptedId) <= 0) {
                return response()->json(['error' => 'Invalid ID format.'], 400);
            }
            $category = Category::findOrFail($decryptedId);
            $category->delete();
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
            $category = Category::findOrFail($decryptedId);
            $category->status = 0;  
            $category->save();      
            return response()->json($category);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            return response()->json(['error' => 'Invalid or corrupted ID.'], 400);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Category not found.'], 404);
        }
    }
}
