<?php

use App\Http\Controllers\ContraindicationController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth']], function () {
    Route::controller(ContraindicationController::class)->prefix('contraindications')->group(function(){
        Route::post('store', 'store')->name('contraindications.store');
        Route::patch('/{id}', 'update')->where('id', '[0-9]+')->name('contraindications.update');
        Route::delete('/{id}', 'destroy')->where('id', '[0-9]+')->name('contraindications.destroy');
    });
});
