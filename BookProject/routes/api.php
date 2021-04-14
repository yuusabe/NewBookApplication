<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookListController;
use App\Http\Controllers\AccountController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//認証チェック
Route::group(['middleware' => 'auth'], function (){
    Route::post('/cognito/change_password', 'App\Http\Controllers\CognitoController@changePassword');
    Route::post('/cognito/create_user', 'App\Http\Controllers\CognitoController@createUser');
});

// ログイン
Route::prefix('login')->group(function () {
    Route::post('/', 'App\Http\Controllers\CognitoController@login');
    Route::post('/first', 'App\Http\Controllers\CognitoController@firstLogin');
    Route::post('/forgot_password', 'App\Http\Controllers\CognitoController@forgotPassword');
    Route::post('/confirm_forgot_password', 'App\Http\Controllers\CognitoController@confirmForgotPassword');
});

// ログアウト
Route::get('logout', 'App\Http\Controllers\LogoutController@deleteCookie');

// Cognito
Route::prefix('cognito')->group(function () {
    Route::post('/delete_user', 'App\Http\Controllers\CognitoController@deleteUser');
    Route::post('/update_user', 'App\Http\Controllers\CognitoController@updateUser');
    Route::get('/list_users', 'App\Http\Controllers\CognitoController@listUsers');
});
// 書籍一覧取得API（ソート機能あり）
Route::get('/book/all_get', [BookListController::class, 'all_get']);

#アカウント登録API
Route::post('/account/add', [AccountController::class, 'store']);
#アカウント情報取得API
Route::get('/account/get', [AccountController::class, 'show']);
#アカウント編集API
Route::post('/account/edit', [AccountController::class, 'update']);
#アカウント削除API
Route::post('/account/delete', [AccountController::class, 'destroy']);
