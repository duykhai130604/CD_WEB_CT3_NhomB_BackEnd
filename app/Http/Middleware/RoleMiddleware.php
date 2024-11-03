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
            $user = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            Log::warning("No user authenticated: " . $e->getMessage());
            return response()->json(['error' => 'Token not provided or invalid'], 401);
        }

        if ($role && $user->role !== $role) {
            Log::warning("User role mismatch: expected {$role}, got {$user->role}");
            return response()->json(['error' => 'Unauthorized: insufficient permissions'], 403);
        }

        return $next($request);
    }
}
