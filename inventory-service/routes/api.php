<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\UploadController;
use App\Http\Middleware\HandleRequestId;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('products', ProductController::class);

Route::post('/stock/{productId}/adjust', [StockController::class, 'adjustStock']);

Route::post('/reservations/reserve', [ReservationController::class, 'reserve'])->middleware([HandleRequestId::class]);

Route::post('/reservations/{reservationId}/commit', [ReservationController::class, 'commit'])->middleware([HandleRequestId::class]);

Route::post('/reservations/{reservationId}/release', [ReservationController::class, 'release'])->middleware([HandleRequestId::class]);

Route::post('/upload', [UploadController::class, 'store']);

Route::get('/presigned-url', [UploadController::class, 'getPresignedUrl']);
