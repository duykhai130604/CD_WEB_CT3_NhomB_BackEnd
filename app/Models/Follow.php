<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    use HasFactory;

    protected $table = 'follows';

    // Để chỉ định các thuộc tính mà bạn cho phép gán (mass assignment)
    protected $fillable = ['user_id', 'product_id'];

    /**
     * Thêm theo dõi sản phẩm
     *
     * @param int $userId
     * @param int $productId
     * @return Follow
     */
    public static function follow(int $userId, int $productId)
    {
        $existingFollow = self::where('user_id', $userId)
            ->where('product_id', $productId)
            ->first();
        if (!$existingFollow) {
            return self::create([
                'user_id' => $userId,
                'product_id' => $productId,
            ]);
        }
        $existingFollow->delete();
        return null;
    }
    public static function checkFollow(int $userId, int $productId)
    {
        return self::where('user_id', $userId)
            ->where('product_id', $productId)
            ->exists();
    }
    public static function getFollowedProducts(int $userId)
    {
        return self::where('user_id', $userId)
            ->join('products as p', 'follows.product_id', '=', 'p.id')
            ->select('p.id as product_id', 'p.name', 'p.price', 'p.discount','p.thumbnail','follows.created_at as created_at','p.desc as desc')  
            ->paginate(10); 
    }
}
