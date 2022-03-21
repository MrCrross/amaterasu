<?php

use App\Http\Controllers\RecordController;
use Illuminate\Support\Facades\Route;

Route::prefix('records')->middleware(['auth'])->controller(RecordController::class)->group(function (){
    Route::get('/','index')->name('records.index');
});

