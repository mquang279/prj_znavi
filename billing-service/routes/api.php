<?php

use App\Http\Controllers\BillController;
use Illuminate\Support\Facades\Route;

Route::prefix('bills')->group(function(){
    Route::get('/',[BillController::class,'getBills']);
    Route::post('/',[BillController::class,'create']);
    Route::post('/{id}/confirm',[BillController::class,'confirm']);
});
