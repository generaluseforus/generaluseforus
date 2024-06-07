<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

// Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('/')->group(function () {
    Route::get('/', [App\Http\Controllers\AccountController::class, 'dashboard'])->name('home');
    Route::get('/index', [App\Http\Controllers\AccountController::class, 'index'])->name('index');

    Route::prefix('/index')->group(function () {
        Route::get('/report', [App\Http\Controllers\AccountController::class, 'report'])->name('report');
        Route::get('/add-expense', [App\Http\Controllers\AccountController::class, 'add_expense'])->name('add-expense');
        Route::post('/save-expense', [App\Http\Controllers\AccountController::class, 'store_expense'])->name('save-expense');
    });
});
