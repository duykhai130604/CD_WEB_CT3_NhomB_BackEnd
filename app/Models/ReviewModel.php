<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ReviewModel extends Model
{
    protected $table ='reviews';  
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
            'product_id' => $data->product_id,
        ]);
    }
    use HasFactory;
}
