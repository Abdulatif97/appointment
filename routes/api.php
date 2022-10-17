<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::group(["middleware" => ['custom_auth']], function () {

    Route::prefix('v1')->group(function () {

        // appointments
        Route::group([
            'prefix'    => 'appointment'
        ], function () {
            Route::get('/', [\App\Http\Controllers\Api\v1\AppointmentsController::class, 'index']);
            Route::get('/show/{id}', [\App\Http\Controllers\Api\v1\AppointmentsController::class, 'show']);
            Route::patch('/change-status/{id}', [\App\Http\Controllers\Api\v1\AppointmentsController::class, 'changeStatus']);
            Route::post('/', [\App\Http\Controllers\Api\v1\AppointmentsController::class, 'store']);
        });
    });
});
