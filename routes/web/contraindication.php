<?php

use App\Http\Controllers\ContraindicationController;
use Illuminate\Support\Facades\Route;

Route::controller(ContraindicationController::class)->prefix('contraindications')->group(function(){
    Route::get('/','index')->name('contraindications.index');
    Route::get('{id}','show')->where('id', '[0-9]+')->name('contraindications.show');
    Route::group(['middleware' => ['auth']], function() {
        Route::get('/create', 'create')->name('contraindications.create');
        Route::get('/{id}/edit', 'edit')->where('id', '[0-9]+')->name('contraindications.edit');
    });
});
