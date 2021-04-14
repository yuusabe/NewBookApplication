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
    Route::get('/forget', function () {
        return view('password_send');
    });
    Route::get('/forget/confirm', function () {
        return view('forget_password_confirm');
    });
});
#アカウント管理画面（アカウント登録・アカウント一覧が見れる）
Route::get('/account_management', function () {
    return view('account_management');
});

#アカウント登録確認画面
Route::get('/account_management_check', function () {
    return view('account_management_check');
});

//マイページ画面
Route::get('/mypage', function () {
    return view('mypage');
});
//パスワード変更画面
Route::get('/password_change', function () {
    return view('password_change');
});
//完了画面
Route::get('/completion', function () {
    return view('completion');
});

