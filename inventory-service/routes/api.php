<?php

use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/hello', function (Request $request) {
    return $request->header('x-request-id');
    // return "hello";
});

Route::apiResource('products', ProductController::class);