<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class CustomAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Lấy token từ cookie
        $token = $request->cookie('token');

        if (!$token) {
            return response()->json(['error' => 'Token not provided'], 401);
        }

        try {
            // Thiết lập token
            JWTAuth::setToken($token);
            // Xác thực người dùng
            $user = JWTAuth::authenticate($token);
            if (!$user) {
                return response()->json(['error' => 'Token is invalid'], 401);
            }

            // Thêm người dùng vào request để sử dụng sau này
            $request->attributes->set('user', $user);
        } catch (JWTException $e) {
            return response()->json(['error' => 'Token is invalid'], 401);
        }

        return $next($request);
    }
}
