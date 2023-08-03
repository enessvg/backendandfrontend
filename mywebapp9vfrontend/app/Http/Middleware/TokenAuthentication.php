<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken; // Laravel Sanctum modelini buraya ekleyin.

class TokenAuthentication
{
    public function handle(Request $request, Closure $next)
    {
        // API tokenini header'dan alıyoruz.
        $token = $request->header('Authorization');

        if (!$token) {
            return response()->json(['error' => 'Unauthorized', 'message' => 'Giriş yapınız!'], 401);
        }

        // personal_access_tokens tablosunda doğrulama yaparak kullanıcıyı alıyoruz.
        $accessToken = PersonalAccessToken::where('token', hash('sha256', $token))
            ->first();

        if (!$accessToken) {
            return response()->json(['error' => 'Invalid token'], 401);
        }

        // Kullanıcının kimliğini belirleyin
        Auth::loginUsingId($accessToken->tokenable_id);

        return $next($request);
    }
}
