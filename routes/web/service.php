<?php

use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

Route::controller(ServiceController::class)->prefix('services')->group(function(){
    Route::get('/','index')->name('services.index');
    Route::get('{id}','show')->where('id', '[0-9]+')->name('services.show');
    Route::group(['middleware' => ['auth']], function() {
        Route::get('/create', 'create')->name('services.create');
        Route::get('/{id}/edit', 'edit')->where('id', '[0-9]+')->name('services.edit');
    });
});
