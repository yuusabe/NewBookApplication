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

#完了画面
Route::get('/completion', function () {
    return view('completion');
});

#書籍一覧画面
Route::get('/list_of_books', function () {
    return view('list_of_books');
});

#アカウント管理画面（アカウント登録・アカウント一覧が見れる）
Route::get('/account_management', function () {
    return view('account_management');
});

#アカウント登録確認画面
Route::get('/account_management_check', function () {
    return view('account_management_check');
});

