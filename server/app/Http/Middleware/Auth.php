<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;
use Symfony\Component\HttpFoundation\Response;

class Auth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->header('Authorization');



        if (!$token || !str_starts_with($token, 'Bearer ')) {
            return response()->json(['message' => 'Unauthorized - Token missing'],401);
        }

        // Lấy chuỗi token không có chữ "Bearer "
        $token = substr($token, 7);

        // Tìm token trong database
        $accessToken = PersonalAccessToken::findToken($token);

        if (!$accessToken) {
            return response()->json(['message' => 'Unauthorized - Invalid token'],401);
        }

        if ($accessToken->expires_at && Carbon::parse($accessToken->expires_at)->isPast()) {
            return response()->json(['message' => 'Token đã hết hạn'],401);
        }

        $user = $accessToken->tokenable;




        return $next($request);
    }
}
