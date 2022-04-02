<?php

use Modules\ApplicationApi\Http\Controllers\ApplicationApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::group(['middleware' => 'auth:api'], function () {

    Route::get('/logindetails', [ApplicationApiController::class, 'logindetails']);

});

Route::post('/loginapi', [ApplicationApiController::class, 'loginapi'])->name('loginApi');
Route::get('/unauthor', [ApplicationApiController::class, 'unauthor'])->name('unauthor');
