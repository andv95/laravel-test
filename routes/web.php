<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
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
//    echo 'OK,',
//    exit();
    return response()->json('Ok,', 200)->header('Content-Type', 'Shift-JIS');
});

Route::get('/payment/success', function () {
    echo 'Successfully action';
})->name('success');

Route::get('/payment/cancel', function () {
    return view('cancel');
//    return redirect()->route('cancel');
});

Route::get('/alert_cancel', function (Request $request) {
    for($i=1; $i<=10000000; $i++) {
        if ($i==10000000) {
            return redirect()->route('error');
        }
    }
//    return redirect()->route('success');
//    print_r($request->all());exit();
//    return view('cancel');
})->name('cancel');

Route::get('/payment/error', function () {
    echo 'error';
})->name('error');

Route::get('/event-listener', 'PageController@eventListener');
Route::post('/event-listener-action', 'PageController@eventListenerAction')->name('event-listener-action');