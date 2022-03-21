<?php

use App\Http\Controllers\RecordController;
use Illuminate\Support\Facades\Route;

Route::prefix('records')->controller(RecordController::class)->group(function (){
    Route::post('store','store')->name('records.store');
    Route::post('{id}','storeClient')->name('records.storeClient');
    Route::patch('{id}','update')->name('records.update');
});

