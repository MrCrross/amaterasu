<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
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

require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/record.php';
require_once __DIR__ . '/service.php';
require_once __DIR__ . '/type.php';
require_once __DIR__ . '/post.php';
require_once __DIR__ . '/indication.php';
require_once __DIR__ . '/contraindication.php';
require_once __DIR__ . '/worker.php';
require_once __DIR__ . '/order.php';
require_once __DIR__ . '/lk.php';
require_once __DIR__ . '/static.php';
