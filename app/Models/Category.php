<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = ['parent_id', 'name', 'status'];
    public static function getCategoriesByPage($perPage = 10)
    {
        return self::paginate($perPage);
    }

    public static function getCategoryById($id)
    {
        return self::findOrFail($id);
    }

    public static function addCategory($data)
    {
        return self::create($data);
    }

    public static function updateCategory($id, $data)
    {
        $category = self::findOrFail($id);
        $category->update($data);
        return $category;
    }

    public static function deleteCategory($id)
    {
        $category = self::findOrFail($id);
        $category->delete();
    }

    public static function changeCategoryStatus($id, $status = 0)
    {
        $category = self::findOrFail($id);
        $category->status = $status;
        $category->save();
        return $category;
    }

    public static function getAllCategories()
    {
        return self::all();
    }
    use HasFactory;
}
