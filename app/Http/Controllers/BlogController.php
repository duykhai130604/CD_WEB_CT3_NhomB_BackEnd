<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function getBlogByPage()
    {
        $blogs = Blog::getBlogsByPage(10);
        return $blogs;
    }
    public function getBlogsByUserPage()
    {
        $blogs = Blog::getBlogsByUserPage();
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
        // Lấy thông tin user từ token
        $user = $request->user();
    
        // Xác thực dữ liệu đầu vào
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5000',
            'status' => 'required|integer',
        ]);
    
        // Thêm user_id vào dữ liệu đã xác thực
        $validatedData['user_id'] = $user->id;
    
        // Nếu có tệp thumbnail, lưu tệp và lấy đường dẫn
        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('uploads/thumbnails', 'public');
            $validatedData['thumbnail'] = $path;
        }
    
        // Tạo blog
        $blog = Blog::create($validatedData);
    
        // Trả về phản hồi JSON
        return response()->json($blog, 201);
    }
    
    
    public function updateBlog(Request $request)
    {
        try {
            // Giải mã ID blog từ request
            $decryptedId = Crypt::decrypt($request->id);
            
            // Kiểm tra tính hợp lệ của ID
            if (!is_numeric($decryptedId) || intval($decryptedId) <= 0) {
                return response()->json(['error' => 'Invalid ID format.'], 400);
            }
    
            // Xác thực dữ liệu đầu vào
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'content' => 'required|string',
                'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5000', // Kiểm tra thumbnail
                'status' => 'required|integer',
            ]);
    
            // Tìm blog cần cập nhật
            $blog = Blog::findOrFail((int)$decryptedId);
    
            // Nếu có tệp thumbnail, lưu và lấy đường dẫn
            if ($request->hasFile('thumbnail')) {
                // Xóa thumbnail cũ nếu có
                if ($blog->thumbnail) {
                    Storage::disk('public')->delete($blog->thumbnail);
                }
    
                // Lưu tệp thumbnail mới và cập nhật đường dẫn
                $path = $request->file('thumbnail')->store('uploads/thumbnails', 'public');
                $validatedData['thumbnail'] = $path;
            }
    
            // Cập nhật blog với dữ liệu mới
            $blog->update($validatedData);
    
            // Trả về phản hồi JSON với dữ liệu blog đã cập nhật
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
            Blog::changeBlogStatus($decryptedId);
            return response()->json("success", 200);
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
