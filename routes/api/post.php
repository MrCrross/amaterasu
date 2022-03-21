<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth']], function () {
    Route::controller(PostController::class)->prefix('posts')->group(function () {
        Route::post('store', 'store')->name('posts.store');
        Route::patch('/{id}', 'update')->where('id', '[0-9]+')->name('posts.update');
        Route::delete('/{id}', 'destroy')->where('id', '[0-9]+')->name('posts.destroy');
    });
});
