<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Behavior extends Model
{
    use HasFactory;

    protected $table = 'behaviors';
    protected $fillable = ['user_id', 'action', 'search_query', 'product_id'];

    // Hàm theo dõi hành vi tìm kiếm sản phẩm
    public static function trackProductSearch($request)
    {
        $searchQuery = $request->input('query'); 

        self::create([
            'user_id' => auth()->id(),
            'action' => 'search',
            'search_query' => $searchQuery,
        ]);
    }

    // Hàm theo dõi hành vi click vào sản phẩm
    public static function trackProductClick($productId)
    {
        self::create([
            'user_id' => auth()->id(),
            'action' => 'click',
            'product_id' => $productId,
        ]);
    }

    // Hàm theo dõi hành vi follow sản phẩm
    public static function trackProductFollow($productId)
    {
        self::create([
            'user_id' => auth()->id(),
            'action' => 'follow',
            'product_id' => $productId,
        ]);
    }
}
