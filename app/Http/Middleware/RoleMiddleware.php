<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, $role = null)
    {
        // Lấy thông tin người dùng đã đăng nhập
        $user = Auth::user();
        // Kiểm tra nếu không có người dùng (chưa đăng nhập)
        if (!$user) {
            Log::warning("No user authenticated");
            return response()->json(['error' => 'Token not provided'], 401);
        }

        // Kiểm tra nếu vai trò không khớp
        if ($user->role !== $role) {
            Log::warning("User role mismatch: expected {$role}, got {$user->role}");
            return response()->json(['error' => 'Unauthorized: insufficient permissions'], 403);
        }

        return $next($request);
    }

}
