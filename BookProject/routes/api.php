<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookListController;
use App\Http\Controllers\LendBookController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\ReturnBookController;
use App\Models\Book;

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

// 仮の書籍登録用API
Route::post('/book/add', function(){
    $post = new Book();
    $post->title = request()->get("title");
    $post->title_furigana = request()->get("title_furigana");
    $post->cover_pic = request()->get("cover_pic");
    $post->publisher = request()->get("publisher");
    $post->author = request()->get("author");
    $post->year_of_issue = request()->get("year_of_issue");
    $post->logic_flag = request()->get("logic_flag");
    $post->save();
    return [];
});

// 書籍一覧取得API（ソート機能あり）
Route::get('/book/all_get', [BookListController::class, 'all_get']);
// 貸出API
Route::post('/book/lend', [LendBookController::class, 'lend']);
// 返却API
Route::post('/book/return', [ReturnBookController::class, 'return']);

#アカウント登録API
Route::post('/account/add', [AccountController::class, 'store']);
#アカウント情報取得API
Route::get('/account/get', [AccountController::class, 'show']);
#アカウント編集API
Route::post('/account/edit', [AccountController::class, 'update']);
#アカウント削除API
Route::post('/account/delete', [AccountController::class, 'destroy']);
