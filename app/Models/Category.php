<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = ['parent_id', 'name', 'status'];
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_category', 'category_id', 'product_id');
    }
    public static function getCategoriesByPage($perPage)
    {
        return self::orderBy('created_at', 'desc')->paginate($perPage);
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
    public static function getCategoryByName($name)
    {
        return self::where('name', $name)->first();
    }
    public static function getCategoryByParentId($parent_id)
    {
        $categories = self::where('parent_id', $parent_id)->get();
        return $categories->isEmpty() ? null : $categories;
    }
    public static function getCategoriesByIds(array $ids)
    {
        return self::whereIn('id', $ids)->get(['id', 'name']);
    }
    public static function getCategoriesByParentId($parentId)
    {
        return self::where('parent_id', $parentId)->get();
    }
    public static function editParent(array $ids, $newParent)
    {
        return self::whereIn('id', $ids)->update(['parent_id' => $newParent]);
    }
    
    use HasFactory;
}
