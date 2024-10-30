<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redis;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;


class AuthController extends Controller
{
    public function register(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Lưu avatar nếu có
        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
        }

        // Tạo người dùng mới
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'avatar' => $avatarPath ?? null
        ]);

        // Tạo JWT token
        $token = JWTAuth::fromUser($user);

        return response()->json(['token' => $token]);
    }


    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'Invalid credentials'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'Could not create token'], 500);
        }
        // Thiết lập cookie HTTP-only với token JWT
        $cookie = cookie('token', $token, 60, null, null, false, true); // 60 phút, HTTP-only
        return response()->json(['message' => 'Logged in successfully', 'user' => auth()->user()])->cookie($cookie);
    }
    public function me(Request $request) 
{
    $user = $request->attributes->get('user'); // Lấy người dùng từ middleware

    if (!$user) {
        return response()->json(['error' => 'User not authenticated'], 401);
    }

    return response()->json([
        'id' => $user->id,
        'name' => $user->name,
        'email' => $user->email
    ]);
}

    public function logout()
    {
        Auth::guard('api')->logout();
        $cookie = cookie()->forget('token');

        return response()->json(['message' => 'Logout successful'])->withCookie($cookie);
    }
    public function refresh()
    {
        $token = Auth::guard('api')->refresh();
        $cookie = cookie('token', $token, 60, '/', null, false, true);

        return response()->json(['message' => 'Token refreshed'])->withCookie($cookie);
    }
    public function user(Request $request)
    {
        return response()->json($request->user());
    }

    public function reset(Request $request)
    {
        // Validate the request data
        $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:8',
        ]);

        // Tìm người dùng theo email
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        // Cập nhật thông tin người dùng
        $user->update([
            'password' => bcrypt($request->password),
        ]);

        // Trả về phản hồi thành công
        return response()->json(['message' => 'User updated successfully']);
    }
}
