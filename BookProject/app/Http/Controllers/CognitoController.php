<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use App\Cognito\CognitoClient;
use App\Services\ApiResponseFormatter;
use App\Services\AuthSetCookie;
use App\Cognito\JwtVerifier;

class CognitoController extends Controller
{
    protected $cognito_client;
    protected $set_cookie;

    public function __construct()
    {
        $this->cognito_client = new CognitoClient;
        $this->set_cookie = new AuthSetCookie;
    }

    //ユーザープール登録
    public function createUser(Request $request)
    {
        // 属性
        // CognitoClientクラスのcognitoAddメソッド呼び出し
        $response = $this->cognito_client->createUser($request->email, $request->password);

        // エラーの場合
        if(Arr::has($response, "errors")){
            $formatter = new ApiResponseFormatter(
                500, $response["message"], $response["errors"]
            );
        // 正常の場合
        }else{
            $formatter = new ApiResponseFormatter(
                200, "ok", $response
            );
        }

        return response()->json(
            $formatter->getResponseArray()
        );
    }

    //ログイン
    public function login(Request $request)
    {
        // CognitoClientクラスのloginメソッドの呼び出し
        $response = $this->cognito_client->login($request->email, $request->password);

        // 初回ログインの場合
        if(Arr::has($response, "ChallengeName")){
            if($response["ChallengeName"] == "NEW_PASSWORD_REQUIRED"){
                $this->set_cookie->firstLoginCookie($request->email, $response["Session"]);

                $formatter = new ApiResponseFormatter(
                    200,"First Login", "ok"
                );
            }
            return response()->json(
                $formatter->getResponseArray()
            );
        }

        // エラーの場合
        // if(Arr::has($response, "errors")){
        if(!empty($response['errors'])){
            $formatter = new ApiResponseFormatter(
                500, $response["message"], $response["errors"]
            );
        // 正常の場合
        }else{
            $set_result = $this->set_cookie->loginCookie($response["AuthenticationResult"], $request->email);
            if($set_result){
                $formatter = new ApiResponseFormatter(
                    200, "ok", "ログイン完了"
                );
            }else{
                $formatter = new ApiResponseFormatter(
                    500, "システムエラー", "入力されたメールアドレスはDBに存在しません。"
                );
            }
        }
        return response()->json(
            $formatter->getResponseArray());
    }

    // 初回ログイン時パスワード変更
    public function firstLogin(Request $request){
        // Cookieからメールアドレスとセッションの取得
        $email = Cookie::get("email");
        $session = Cookie::get("cognito_session");

        // CognitoClientクラスのfirstLoginメソッドの呼び出し
        $response = $this->cognito_client->firstLogin($email, $request->password, $session);

        // エラーの場合
        if(Arr::has($response, "errors")){
            $formatter = new ApiResponseFormatter(
                500, $response["message"], $response["errors"]
            );
        // 正常の場合
        }else{
            Cookie::queue(Cookie::forget("email"));
            Cookie::queue(Cookie::forget("cognito_session"));
            $set_result = $this->set_cookie->loginCookie($response["AuthenticationResult"], $email);
            if($set_result){
                $formatter = new ApiResponseFormatter(
                    200, "ok", "ログイン完了"
                );
            }else{
                $formatter = new ApiResponseFormatter(
                    500, "システムエラー。管理者にお問い合わせください。", "入力されたメールアドレスはDBに存在しません。"
                );
            }
        }
        return response()->json(
            $formatter->getResponseArray()
        );
    }

    // パスワード紛失
    public function forgotPassword(Request $request)
    {
        $response = $this->cognito_client->forgotPassword($request->email);

        if(Arr::has($response, "errors")){
            $formatter = new ApiResponseFormatter(
                500, $response["message"], $response["errors"]
            );
        }else{
            $formatter = new ApiResponseFormatter(
                200, "ok", "Forgot Password Challenge Start."
            );
        }
        return response()->json(
            $formatter->getResponseArray()
        );
    }

    public function changePassword(Request $request)
    {
        $access_token = Cookie::get("access_token");

        $response = $this->cognito_client->changePassword($request->previous_password, $request->proposed_password, $access_token);

        if(Arr::has($response, "errors")){
            $formatter = new ApiResponseFormatter(
                500, $response["message"], $response["errors"]
            );
        }else{
            $formatter = new ApiResponseFormatter(
                200, "ok", "Change Password Complete."
            );
        }

        return response()->json(
            $formatter->getResponseArray()
        );
    }

    public function deleteUser(Request $request)
    {
        $id_token = Cookie::get("id_token");

        $response = $this->cognito_client->deleteUser($request->email, $id_token);

        if(Arr::has($response, "errors")){
            $formatter = new ApiResponseFormatter(
                500, $response["message"], $response["errors"]
            );
        }else{
            $formatter = new ApiResponseFormatter(
                200, "ok", "Delete User Complete."
            );
        }

        return response()->json(
            $formatter->getResponseArray()
        );
    }
}