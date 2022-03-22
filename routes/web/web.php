<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[MainController::class, 'index'])->name('main');

Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
});

require __DIR__ . '/auth.php';
require __DIR__ . '/record.php';
require __DIR__ . '/service.php';
require __DIR__ . '/type.php';
require __DIR__ . '/post.php';
require __DIR__ . '/indication.php';
require __DIR__ . '/contraindication.php';
require __DIR__ . '/worker.php';
require __DIR__ . '/order.php';
require __DIR__ . '/lk.php';