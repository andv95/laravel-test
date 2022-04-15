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
Route::get('/', function () {
    return view('welcome');
});

Route::post('/payment/call_back_function', function () {
    return json_encode('OK;');
});

Route::post('/payment/success', function () {
    echo 'success';
});

Route::post('/payment/cancel', function () {
    return redirect()->route('cancel');
});

Route::get('/alert_cancel', function () {
    return view('cancel');
})->name('cancel');

Route::post('/payment/error', function () {
    echo 'error';
});
