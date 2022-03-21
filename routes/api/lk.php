<?php

use App\Http\Controllers\LkController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth']], function () {
    Route::controller(LkController::class)->prefix('lk')->group(function () {
        Route::patch('/{id}', 'update')->where('id', '[0-9]+')->name('lk.update');
    });
});
