<?php

use Modules\Auth\Http\Controllers\LoginController;

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

Route::prefix('auth')->group(function () {
    Route::get('/welcome', [LoginController::class, 'show'])->name('welcomeRoute')->middleware('gaurd')->middleware('disable_Back');
    Route::get('/welcome/update/{id}', [LoginController::class, 'update'])->name('updateWelcomeRoute')->middleware('disable_Back');

    Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('disable_Back');
    Route::get('/logout', [LoginController::class, 'logout'])->name('LogoutRoute')->middleware('disable_Back');

    Route::post('/login', [LoginController::class, 'store'])->name('formLoginRoute');
    Route::post('/actionP/{id}', [LoginController::class, 'actionPermission'])->name('actionRoute');

    Route::get('/adminList', [LoginController::class, 'showAdmin'])->name('adminRoute')->middleware('disable_Back');
    Route::get('/managerList', [LoginController::class, 'showManager'])->name('managerRoute')->middleware('disable_Back');
    Route::get('/devList', [LoginController::class, 'showDev'])->name('devRoute')->middleware('disable_Back');
});
