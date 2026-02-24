<?php

use App\Exceptions\InsufficientStockException;
use App\Exceptions\ConFlictState;
use App\Http\Middleware\HandleInertiaRequests;
use App\Http\Middleware\RequestIdMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use function Pest\Laravel\get;
use function Termwind\render;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        // web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        api: __DIR__.'/../routes/api.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->api(prepend: [
            RequestIdMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {

        $exceptions->render(function(ValidationException $e, Request $request){
                return response()->json([
                    'error'=>[
                        'code'=>'VALIDATION_ERROR',
                        'message'=>'Validation failed',
                        'details'=>$e->errors(),
                    ],
                    'requestId'=>$request->attributes->get('x-request-id'),
                ],400);
        });

         $exceptions->render(function(InsufficientStockException $e, Request $request){
                 return response()->json([
                     'error'=>[
                         'code'=>'INSUFFICIENT_STOCK',
                         'message'=>$e->getMessage(),
                         'details'=>$e->getDetails(),
                     ],
                     'requestId'=>$request->attributes->get('x-request-id'),
                 ],409);
         });
        $exceptions->render(function(ConFlictState $e, Request $request){
            return response()->json([
                'error'=>[
                    'code'=>'CONFLICT_STATE',
                    'message'=>$e->getMessage(),
                    'details'=>$e->getDetails() ??[],
                ],
                'requestId'=>$request->attributes->get('x-request-id'),
            ],409);
        });
        $exceptions->render(function(NotFoundHttpException $e, Request $request){
                return response()->json([
                    'error'=>[
                        'code'=>'NOT_FOUND',
                        'message'=>$e->getMessage(),
                    ],
                    'requestId'=>$request->headers->get('x-request-id'),
                ],404);
        });

        $exceptions->render(function(Throwable $e, Request $request){
            if (config('app.debug')) {
                throw $e;
            }

            return response()->json([
                'error'=>[
                    'code'=>'INTERNAL_ERROR',
                    'message'=>'Unexpected error',
                ],
                'requestId'=>$request->attributes->get('request-id'),
            ],500);
        });
    })->create();
