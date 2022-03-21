<?php

use App\Http\Controllers\WorkerController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth']], function () {
    Route::controller(WorkerController::class)->prefix('workers')->group(function(){
        Route::post('store', 'store')->name('workers.store');
        Route::post('check', 'check')->name('workers.check');
        Route::patch('/{id}', 'update')->where('id', '[0-9]+')->name('workers.update');
        Route::delete('/{id}', 'destroy')->where('id', '[0-9]+')->name('workers.destroy');
    });
});
