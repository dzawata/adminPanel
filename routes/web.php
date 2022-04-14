<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UsersController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')
    // ->middleware([''])
    ->group(function ($router) {
        Route::get('/', [DashboardController::class, 'index']);
        Route::get('dashboard', [DashboardController::class, 'index']);
        Route::get('users', [UsersController::class, 'index'])->name('users');
        Route::get('users/create', [UsersController::class, 'create'])->name('add-users');
    });
