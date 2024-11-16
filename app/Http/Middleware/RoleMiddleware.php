<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, $role = null)
    {
        try {
            // Lấy token từ tham số 'token' trong query string
            $token = $request->input('token');

            // Nếu không có token, trả về lỗi
            if (!$token) {
                Log::warning("No token provided");
                return response()->json(['error' => 'Token not provided'], 401);
            }

            // Xác thực người dùng với token lấy từ tham số
            $user = JWTAuth::setToken($token)->authenticate();
        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            // Nếu token hết hạn
            Log::warning("Token expired: " . $e->getMessage());
            return response()->json(['error' => 'Token has expired'], 401);
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            // Nếu token không hợp lệ
            Log::warning("Invalid token: " . $e->getMessage());
            return response()->json(['error' => 'Invalid token'], 401);
        } catch (\Exception $e) {
            // Nếu xảy ra lỗi khác
            Log::warning("Authentication failed: " . $e->getMessage());
            return response()->json(['error' => 'Authentication failed'], 401);
        }

        // Kiểm tra vai trò nếu có
        if ($role) {
            // Nếu yêu cầu role 'admin', kiểm tra nếu người dùng là admin
            if ($role === 'admin' && $user->role !== 'admin') {
                Log::warning("User role mismatch: expected admin, got {$user->role}");
                return response()->json(['error' => 'Unauthorized: Admin role required'], 403);
            }

            // Nếu yêu cầu role 'user', kiểm tra nếu người dùng là user
            if ($role === 'user' && $user->role !== 'user' && $user->role !== 'admin') {
                // Thêm điều kiện cho phép admin sử dụng quyền user
                Log::warning("User role mismatch: expected user, got {$user->role}");
                return response()->json(['error' => 'Unauthorized: User role required'], 403);
            }
        }

        return $next($request);
    }
}
