<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth']], function () {
    Route::controller(PostController::class)->prefix('posts')->group(function () {
        Route::get('/', 'index')->name('posts.index');
        Route::get('{id}', 'show')->where('id', '[0-9]+')->name('posts.show');
        Route::get('/create', 'create')->name('posts.create');
        Route::get('/{id}/edit', 'edit')->where('id', '[0-9]+')->name('posts.edit');
    });
});
