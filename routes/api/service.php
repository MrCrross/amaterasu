<?php

use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth']], function () {
    Route::controller(ServiceController::class)->prefix('services')->group(function () {
        Route::post('store', 'store')->name('services.store');
        Route::post('check', 'check')->name('services.check');
        Route::patch('/{id}', 'update')->where('id', '[0-9]+')->name('services.update');
        Route::delete('/{id}', 'destroy')->where('id', '[0-9]+')->name('services.destroy');
    });
});
