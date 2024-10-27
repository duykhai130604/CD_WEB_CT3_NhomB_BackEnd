<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $table = 'blogs';
    protected $fillable = ['title', 'content', 'thumbnail', 'user_id','status'];
    public static function getBlogsByPage($perPage = 10)
    {
        return self::orderBy('created_at', 'desc')->paginate($perPage);
    }
    public static function getBlogsByUserPage($perPage )
    {
        return self::orderBy('created_at', 'desc')->paginate($perPage);
    }

    public static function getBlogById($id)
    {
        return self::findOrFail($id);
    }

    public static function addBlog($data)
    {
        return self::create($data);
    }

    public static function updateBlog($id, $data)
    {
        $blog = self::findOrFail($id);
        $blog->update($data);
        return $blog;
    }

    public static function deleteBlog($id)
    {
        $blog = self::findOrFail($id);
        $blog->delete();
    }

    public static function changeBlogStatus($id)
    {
          $blog = Blog::findOrFail($id);
          $blog->status = ($blog->status === 1 || $blog->status === 0) ? -1 : $blog->status;
          $blog->save();
        return $blog;
    }

    public static function getAllBlogs()
    {
        return self::all();
    }
    public static function getBlogByAuthorId($id)
    {
        return self::orderBy('created_at', 'desc')->where('user_id', $id)->paginate(3);
    }
   
    
    use HasFactory;
}
