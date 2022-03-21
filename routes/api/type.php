<?php

use App\Http\Controllers\ServiceTypeController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth']], function () {
    Route::controller(ServiceTypeController::class)->prefix('types')->group(function () {
        Route::post('store', 'store')->name('types.store');
        Route::patch('/{id}', 'update')->where('id', '[0-9]+')->name('types.update');
        Route::delete('/{id}', 'destroy')->where('id', '[0-9]+')->name('types.destroy');
    });
});
