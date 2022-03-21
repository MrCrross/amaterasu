<?php

use App\Http\Controllers\WorkerController;
use Illuminate\Support\Facades\Route;

Route::controller(WorkerController::class)->prefix('workers')->group(function(){
    Route::get('/','index')->name('workers.index');
    Route::get('{id}','show')->where('id', '[0-9]+')->name('workers.show');
    Route::group(['middleware' => ['auth']], function() {
        Route::get('/create', 'create')->name('workers.create');
        Route::get('/{id}/edit', 'edit')->where('id', '[0-9]+')->name('workers.edit');
    });
});
