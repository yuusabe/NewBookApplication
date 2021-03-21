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
