<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class HandleRequestId
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $key = $request->header('x-request-id');
        $url = $request->url();

        if (!$key) {
            return response()->json([
                'message' => 'Missing x-request-id header'
            ], 400);
        }

        $reservation = DB::table('stock_reservations')
            ->where('request_id', $key)
            ->first();

        if ($reservation && ($reservation->status !== 'RESERVED' || str_contains($url, 'reserve'))) {
            return response()->json([
                'data' => $reservation
            ], 200);
        }
        Log::info('Incoming request', [
            'request_id' => $request->header('x-request-id'),
            'path' => $request->path(),
        ]);
        return $next($request);
    }

}
