<?php

use App\Http\Controllers\RecordController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('record')->controller(RecordController::class)->group(function (){
    Route::post('/create','create')->name('record.create');
});

