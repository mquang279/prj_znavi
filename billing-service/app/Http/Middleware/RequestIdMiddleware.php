<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class RequestIdMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $requestId = $request->headers->get('x-request-id');
        if(empty($requestId)){
            $requestId= Str::uuid();
        }
        $request->attributes->set('x-request-id',$requestId);
        Log::withContext([
            'requestId' => $requestId,
            'path' => $request->path(),
            'method' => $request->method(),
        ]);
        $response = $next($request);
        $response->headers->set('x-request-id',$requestId);
        return $response;
    }
}
