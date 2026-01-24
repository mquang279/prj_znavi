<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class HandleRequestId
{
    public function handle(Request $request, Closure $next): Response
    {
        $requestId = (string) Str::uuid();

        $request->headers->set('x-request-id', $requestId);

        Log::shareContext([
            'request_id' => $requestId
        ]);

        $response = $next($request);

        $response->headers->set('x-request-id', $requestId);

        return $response;
    }
}
