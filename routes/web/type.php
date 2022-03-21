<?php

use App\Http\Controllers\ServiceTypeController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth']], function() {
Route::controller(ServiceTypeController::class)->prefix('types')->group(function(){
    Route::get('/','index')->name('types.index');
    Route::get('{id}','show')->where('id', '[0-9]+')->name('types.show');
    Route::get('/create', 'create')->name('types.create');
    Route::get('/{id}/edit', 'edit')->where('id', '[0-9]+')->name('types.edit');
});
});
