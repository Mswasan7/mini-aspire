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

Route::prefix('v1')->group(function () {
    Route::post('login', [\App\Http\Controllers\API\V1\Auth\LoginController::class, 'login'])->name('v1.login');

    Route::middleware('auth:sanctum')->group(function () {
        Route::resource('loan', \App\Http\Controllers\API\V1\Loan\LoanController::class)->only(['store', 'index', 'show']);
        Route::patch('loan/approve/{id}', [\App\Http\Controllers\API\V1\Loan\ApproveLoanController::class,'update']);
    });
});


