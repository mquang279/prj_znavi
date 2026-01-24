<?php

use App\Http\Middleware\HandleInertiaRequests;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        commands: __DIR__.'/../routes/console.php',
        api: __DIR__.'/../routes/api.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // $middleware->web(append: [
        //     HandleInertiaRequests::class,
        //     AddLinkHeadersForPreloadedAssets::class,
        // ]);
        $middleware->append(\App\Http\Middleware\HandleRequestId::class);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
