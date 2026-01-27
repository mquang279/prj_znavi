<?php

use App\Http\Controllers\BillController;
use Illuminate\Support\Facades\Route;

Route::prefix('bill')->group(function(){
    Route::get('/',[BillController::class,'getBills']);
    Route::post('/',[BillController::class,'create']);
});
