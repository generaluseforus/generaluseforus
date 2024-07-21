<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OTPController;

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
        Route::prefix('/report')->group(function () {
            Route::get('/', [App\Http\Controllers\AccountController::class, 'report'])->name('report');
            Route::get('/{id}', [App\Http\Controllers\AccountController::class, 'report'])->name('report.id');
        });

        Route::get('/add-expense', [App\Http\Controllers\AccountController::class, 'add_expense'])->name('add-expense');
        Route::post('/save-expense', [App\Http\Controllers\AccountController::class, 'store_expense'])->name('save-expense');
        Route::get('/edit-expense/{id}', [App\Http\Controllers\AccountController::class, 'edit_expense'])->name('edit-expense');
        Route::post('/update-expense/{id}', [App\Http\Controllers\AccountController::class, 'update_expense'])->name('update-expense');
        Route::get('/delete-expense/{id}', [App\Http\Controllers\AccountController::class, 'delete_expense'])->name('delete-expense');
    });

    Route::get('/mail', [App\Http\Controllers\AllMailController::class, 'sendMail'])->name('mail');

    // Route to show the OTP form
    Route::get('/otp', [OTPController::class, 'show'])->name('otp.show');

    // Route to handle OTP submission
    Route::post('/otp', [OTPController::class, 'sendOTP'])->name('otp.send');

    // Route to verify OTP
    Route::post('/otp/verify', [OTPController::class, 'verifyOTP'])->name('otp.verify');
});
