<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class BlogController extends Controller
{
    public function getBlogByPage()
    {
        $blogs = Blog::getBlogsByPage(10);
        return $blogs;
    }
    public function getBlogsByUserPage()
    {
        $blogs = Blog::getBlogsByUserPage(3);
        return $blogs;
    }
    public function getBlogById($encryptedId)
    {
        try {
            $decryptedId = Crypt::decrypt($encryptedId);
            if (!is_numeric($decryptedId) || intval($decryptedId) <= 0) {
                return response()->json(['error' => 'Invalid ID format.'], 400);
            }
            //hàm này phải gọi từ model
            $blog = Blog::findOrFail($decryptedId);
            return response()->json($blog);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            return response()->json(['error' => 'Invalid or corrupted ID.'], 400);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Blog not found.'], 404);
        }
    }

    public function addBlog(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'thumbnail' => 'image|mimes:jpeg,png,jpg,gif|max:5000',
            'user_id' => 'required|integer',
            'status' => 'required|integer',
        ]);

        $blog = Blog::create($validatedData);
        return response()->json($blog, 201);
    }

    public function updateBlog(Request $request, $encryptedId)
    {
        try {
            $decryptedId = Crypt::decrypt($encryptedId);
            if (!is_numeric($decryptedId) || intval($decryptedId) <= 0) {
                return response()->json(['error' => 'Invalid ID format.'], 400);
            }

            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'content' => 'required|string',
                'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'user_id' => 'required|integer',
            ]);
            //hàm này phải gọi từ model
            $blog = Blog::findOrFail($decryptedId);
            $blog->update($validatedData);
            return response()->json($blog);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            return response()->json(['error' => 'Invalid or corrupted ID.'], 400);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Blog not found.'], 404);
        }
    }

    public function deleteBlog($encryptedId)
    {
        try {
            $decryptedId = Crypt::decrypt($encryptedId);
            if (!is_numeric($decryptedId) || intval($decryptedId) <= 0) {
                return response()->json(['error' => 'Invalid ID format.'], 400);
            }
            Blog::deleteBlog($decryptedId);
            return response()->json(null, 204);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            return response()->json(['error' => 'Invalid or corrupted ID.'], 400);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Blog not found.'], 404);
        }
    }

    public function changeBlogStatus($encryptedId)
    {
        try {
            $decryptedId = Crypt::decrypt($encryptedId);
            if (!is_numeric($decryptedId) || intval($decryptedId) <= 0) {
                return response()->json(['error' => 'Invalid ID format.'], 400);
            }
            //hàm này phải gọi từ model
            $blog = Blog::findOrFail($decryptedId);
            $blog->status = ($blog->status === 1) ? 0 : 1;
            $blog->save();
            return response()->json($blog);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            return response()->json(['error' => 'Invalid or corrupted ID.'], 400);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Blog not found.'], 404);
        }
    }

    public function getAllBlogs()
    {
        $blogs = Blog::getAllBlogs();
        return response()->json($blogs);
    }
    public function getNameUserByIds(Request $request)
    {
        $ids = explode(',', $request->input('ids'));
        $names = User::getUserByIds($ids);
        return response()->json($names);
    }
    public function getBlogsByAuthorId($id)
    {
        $decrypId = Crypt::decrypt($id);
        if (!is_numeric($decrypId) || intval($decrypId) <= 0) {
            return response()->json(['error' => 'Invalid ID format.'], 400);
        }
        $blogs = Blog::getBlogByAuthorId($decrypId);
        return response()->json($blogs);
    }
    public function getAuthorsWithCountBlog()
    {
        $users = User::getUsersWithBlogCount();
        return response()->json($users);
    }
}
