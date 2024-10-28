<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Log;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Session;

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
        $user = $request->validate(['email' => 'required',
                                            'password' => 'required']);   
        $user = User::where('email', $request->email)->first();
        session::put('id',$user->id);
                session('login');
                $request->session()->put('login.user_id', $user->id);   
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'Invalid credentials'], 401);
            }
            // Retrieve user ID
            $user = JWTAuth::user();
            $userId = $user->id;
        } catch (JWTException $e) {
            return response()->json(['error' => 'Could not create token'], 500);
        }
        return response()->json(['token' => $token]);
       // return redirect()->route('home')->with('user_id', $userId);
    }
   
    public function logout()
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());
            return response()->json(['message' => 'Successfully logged out']);
        } catch (JWTException $e) {
            return response()->json(['error' => 'Failed to log out, please try again.'], 500);
        }
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

