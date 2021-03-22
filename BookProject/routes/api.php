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

<<<<<<< HEAD
//認証チェック
Route::group(['middleware' => 'auth'], function (){

});

//ログイン
Route::prefix('login')->group(function () {
    Route::post('/', 'App\Http\Controllers\CognitoController@login');
    Route::post('/first', 'App\Http\Controllers\CognitoController@firstLogin');
});

//Cognito
Route::prefix('cognito')->group(function () {
    Route::post('add', 'App\Http\Controllers\CognitoController@cognitoAdd');
});
=======
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
>>>>>>> 63de6034b745b9eabf3e2b958cc474d94737554f
