<?php
use Illuminate\Support\Facades\Redis;

class CheckBlacklist
{
    public function handle($request, Closure $next)
    {
        $token = $request->bearerToken();
        if (Redis::exists('blacklist:'.$token)) {
            return response()->json(['message' => 'Token is blacklisted'], 401);
        }
        return $next($request);
    }
}
