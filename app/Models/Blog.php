<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $table = 'blogs';
    protected $fillable = ['title', 'content', 'thumbnail', 'user_id'];
    public static function getBlogsByPage($perPage = 10)
    {
        return self::paginate($perPage);
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

    public static function changeBlogStatus($id, $status = 0)
    {
        $blog = self::findOrFail($id);
        $blog->status = $status;
        $blog->save();
        return $blog;
    }

    public static function getAllBlogs()
    {
        return self::all();
    }
    use HasFactory;
}
