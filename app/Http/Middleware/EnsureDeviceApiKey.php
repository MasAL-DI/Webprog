<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureDeviceApiKey
{
    public function handle(Request $request, Closure $next): Response
    {
        $key = $request->header('X-Device-Key');

        if (! $key || ! hash_equals((string) config('services.device.api_key'), $key)) {
            return response()->json(['pesan' => 'API key alat tidak valid.'], 401);
        }

        return $next($request);
    }
}
