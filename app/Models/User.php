<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail;

use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = "users";
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    /**
     * Implement JWTSubject methods
     */
    public function getJWTIdentifier()
    {
        // Trả về khóa chính (ID) của user
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        // Thêm các claims tùy chỉnh vào JWT nếu cần, ở đây trả về mảng trống
        return [];
    }
    public static function getUserByIds($ids)
    {
        return self::whereIn('id',$ids)->get(['id','name']);
    }
    public function blogs()
    {
        return $this->hasMany(Blog::class, 'user_id');
    }
    public static function getUsersWithBlogCount()
    {
        return self::select('users.*')
        ->selectRaw('COUNT(blogs.id) as blog_count')
        ->join('blogs', 'users.id', '=', 'blogs.user_id')
        ->groupBy('users.id')
        ->paginate(5);
    }
    public static function countUsers()
    {
        $userCount = User::count();
        return response()->json([
            'message' => 'Total users retrieved successfully',
            'total_users' => $userCount
        ]);
    }
}
