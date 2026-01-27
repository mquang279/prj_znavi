<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\StockController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/hello', function (Request $request) {
    return $request->header('x-request-id');
    // return "hello";
});

Route::apiResource('products', ProductController::class);

Route::post('/stock/{productId}/adjust', [StockController::class, 'adjustStock']);