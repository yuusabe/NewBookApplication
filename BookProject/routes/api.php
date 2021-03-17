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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('index', 'App\Http\Controllers\TestApiController@index');

use App\Http\Controllers\AccountController;

#アカウント登録API
Route::post('/account/add', [AccountController::class, 'store']);
#アカウント情報取得API
Route::get('/account/get', [AccountController::class, 'show']);
#アカウント編集API
Route::post('/account/edit', [AccountController::class, 'update']);
#アカウント削除API
Route::post('/account/delete', [AccountController::class, 'destroy']);