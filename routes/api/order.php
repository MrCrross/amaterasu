<?php

use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth']], function () {
    Route::controller(OrderController::class)->prefix('orders')->group(function () {
        Route::post('store', 'store')->name('orders.store');
        Route::patch('{id}', 'update')->where('id', '[0-9]+')->name('orders.update');
        Route::put('{id}', 'close')->where('id', '[0-9]+')->name('orders.close');
        Route::delete('{id}', 'destroy')->where('id', '[0-9]+')->name('orders.destroy');
    });
});
