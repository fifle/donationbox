<?php
// app/Http/Middleware/SecurityHeaders.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SecurityHeaders
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        $response->headers->set("X-Frame-Options", "SAMEORIGIN");
        $response->headers->set("X-Content-Type-Options", "nosniff");
        $response->headers->set("X-XSS-Protection", "1; mode=block");
        $response->headers->set(
            "Referrer-Policy",
            "strict-origin-when-cross-origin"
        );

        // Only if you need to allow Telegram's WebView
        if (strpos($request->userAgent(), "Telegram") !== false) {
            $response->headers->set(
                "X-Frame-Options",
                "ALLOW-FROM https://t.me/"
            );
        }

        return $response;
    }
}
