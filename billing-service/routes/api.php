<?php

use App\Http\Controllers\BillController;

Route::prefix('bills')->group(function(){
    Route::get('/',[BillController::class,'getBills']);
    Route::post('/',[BillController::class,'create']);
    Route::post('/{id}/confirm',[BillController::class,'confirm']);
});
