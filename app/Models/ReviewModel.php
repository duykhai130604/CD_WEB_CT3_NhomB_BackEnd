<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ReviewModel extends Model
{
    protected $table ='reviews';  
    protected $fillable = [
        'content',
        'rating',
        'user_id',
        'variant',
        'product_id'
    ];
    // public function checkUserHaveRated($variant, $user){
    //     $reviewCount = DB::table('reviews')
    //     ->where('product_id', $variant)
    //     ->where('user_id', $user)
    //     ->count();
    // return $reviewCount;
    // }
    public function store($data){
        return  self::create([
            'content' => $data->content,
            'rating' => $data->rating,
            'user_id' => $data->user_id,
            'variant' => $data->variant,
            'product_id' => $data->product_id,
        ]);
    }
    public static function getReviewByProduct($product){
         $reviews = DB::table('reviews as r')
        ->join('product_variants as pv', 'r.variant', '=', 'pv.id')
        ->join('sizes as s', 'pv.size_id', '=', 's.id')
        ->join('colors as c', 'pv.color_id', '=', 'c.id')
        ->join('users as u', 'r.user_id', '=', 'u.id')
        ->where('r.product_id', $product)
        ->select('r.*','u.name as user', 's.name as size', 'c.name as color')
        ->paginate(10);
        return $reviews;
    }
    public static function getRating($product)
    {
        $ratting = DB::table('reviews as r')
            ->selectRaw('AVG(r.rating) as avg_rating, COUNT(*) as review_count')
            ->where('r.product_id', $product) 
            ->first();
        return $ratting;
    }
    
    use HasFactory;
}
