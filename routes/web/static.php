<?php

use App\Http\Controllers\StaticController;
use Illuminate\Support\Facades\Route;

Route::controller(StaticController::class)->prefix('statics')->group(function(){
    Route::get('/','index')->name('static.index');
});
