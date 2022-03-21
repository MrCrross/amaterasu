<?php

use App\Http\Controllers\IndicationController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth']], function () {
    Route::controller(IndicationController::class)->prefix('indications')->group(function(){
        Route::post('store', 'store')->name('indications.store');
        Route::patch('/{id}', 'update')->where('id', '[0-9]+')->name('indications.update');
        Route::delete('/{id}', 'destroy')->where('id', '[0-9]+')->name('indications.destroy');
    });
});
