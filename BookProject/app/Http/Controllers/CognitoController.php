<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use App\Cognito\CognitoClient;
use App\Services\ApiResponseFormatter;
use App\Cognito\JwtVerifier;

class CognitoController extends Controller
{
    public function cognitoAdd(Request $request)
    {
        // 属性
        $attributes = [];
        // CognitoClientクラスのcognitoAddメソッド呼び出し
        $cognito_client = new CognitoClient;
        $cognito_add = $cognito_client->cognitoAdd($request->email, $request->password, $attributes);

        // エラーの場合
        if(Arr::has($cognito_add, "errors")){
            $formatter = new ApiResponseFormatter(
                500, $cognito_add["message"], $cognito_add["errors"]
            );
        // 正常の場合
        }else{
            $formatter = new ApiResponseFormatter(
                200, "ok", "Account Add Complete"
            );
        }

        return response()->json(
            $formatter->getResponseArray()
        );
    }

    public function login(Request $request)
    {
        // CognitoClientクラスのloginメソッドの呼び出し
        $cognito_client = new CognitoClient;
        $login = $cognito_client->login($request->email, $request->password);

        // 初回ログインの場合
        if(Arr::has($login, "ChallengeName")){
            if($login["ChallengeName"] == "NEW_PASSWORD_REQUIRED"){
                Cookie::queue("email", $request->email);
                Cookie::queue("cognito_session", $login["Session"]);
                $formatter = new ApiResponseFormatter(
                    200,"First Login", "ok"
                );
            }
            return response()->json(
                $formatter->getResponseArray()
            );
        }

        // エラーの場合
        if(Arr::has($login, "errors")){
            $formatter = new ApiResponseFormatter(
                500, $login["message"], $login["errors"]
            );
        // 正常の場合
        }else{
            Cookie::queue("id_token", $login["AuthenticationResult"]["IdToken"], 60);
            Cookie::queue("refresh_token", $login["AuthenticationResult"]["RefreshToken"], 60);
            $formatter = new ApiResponseFormatter(
                200, "ok", "ログイン完了"
            );
        }
        return response()->json(
            $formatter->getResponseArray());
    }

    public function firstLogin(Request $request){
        // Cookieからメールアドレスとセッションの取得
        $email = Cookie::get("email");
        $session = Cookie::get("cognito_session");

        // CognitoClientクラスのfirstLoginメソッドの呼び出し
        $cognito_client = new CognitoClient;
        $first_login = $cognito_client->firstLogin($email, $request->password, $session);

        // エラーの場合
        if(Arr::has($first_login, "errors")){
            $formatter = new ApiResponseFormatter(
                500, $first_login["message"], $first_login["errors"]
            );
        // 正常の場合
        }else{
            Cookie::queue(Cookie::forget("email"));
            Cookie::queue(Cookie::forget("cognito_session"));
            Cookie::queue("id_token", $first_login["AuthenticationResult"]["IdToken"], 60);
            Cookie::queue("refresh_token", $first_login["AuthenticationResult"]["RefreshToken"], 60);
            $formatter = new ApiResponseFormatter(
                200, "ok", $first_login["AuthenticationResult"]
            );
        }
        return response()->json(
            $formatter->getResponseArray()
        );
    }

}