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

Route::get('/list_of_books', function () {
    return view('list_of_books');
});

Route::prefix('login')->group(function () {
    Route::get('/', function () {
        return view('login');
    });
    Route::get('/check', function () {
        return view('login_check');
    });
    Route::get('/first', function () {
        return view('login_first');
    });
});