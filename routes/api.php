<?php

use App\Http\Controllers\Api\PassportController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function () {
    Route::post('register', [PassportController::class, 'register']);
    Route::post('login', [PassportController::class, 'login']);

    Route::middleware('auth:api')->group(function () {
        Route::get('user', [PassportController::class, 'authenticatedUserDetails']);
        Route::get('logout', [PassportController::class, 'logout']);
    });
});
