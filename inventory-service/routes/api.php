<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/hello', function (Request $request ) {
    // return "Hello from Inventory Service";
    return $request->header('x-request-id');
});
