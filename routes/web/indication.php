<?php

use App\Http\Controllers\IndicationController;
use Illuminate\Support\Facades\Route;

Route::controller(IndicationController::class)->prefix('indications')->group(function(){
    Route::get('/','index')->name('indications.index');
    Route::get('{id}','show')->where('id', '[0-9]+')->name('indications.show');
    Route::group(['middleware' => ['auth']], function() {
        Route::get('/create', 'create')->name('indications.create');
        Route::get('/{id}/edit', 'edit')->where('id', '[0-9]+')->name('indications.edit');
    });
});
