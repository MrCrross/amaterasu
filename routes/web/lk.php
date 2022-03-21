<?php

use App\Http\Controllers\LkController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth']], function () {
    Route::controller(LkController::class)->prefix('lk')->group(function () {
        Route::get('{id}','index')->name('lk.index');
        Route::get('{id}/edit','edit')->name('lk.edit');
    });
});
