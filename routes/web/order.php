<?php

use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth']], function () {
    Route::controller(OrderController::class)->prefix('orders')->group(function () {
        Route::get('/', 'index')->name('orders.index');
        Route::get('{id}', 'show')->where('id', '[0-9]+')->name('orders.show');
        Route::get('create', 'create')->name('orders.create');
        Route::get('{id}/record', 'record')->where('id', '[0-9]+')->name('orders.record');
        Route::get('{id}/schedule', 'schedule')->where('id', '[0-9]+')->name('orders.schedule');
        Route::get('{id}/edit', 'edit')->where('id', '[0-9]+')->where('id', '[0-9]+')->name('orders.edit');
    });
});
