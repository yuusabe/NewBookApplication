<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use App\Cognito\CognitoClient;
use App\Cognito\JwtVerifier;
use App\Services\AuthSetCookie;
use App\Services\ApiResponseFormatter;

class CognitoAuthVerifier
{
    protected $region;
    protected $clientId;
    protected $poolId;
    protected $set_cookie;

    public function __construct(){
        $this->region = config("cognito.region");
        $this->clientId = config("cognito.clientId");
        $this->poolId = config("cognito.poolId");
        $this->set_cookie = new AuthSetCookie;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        //Cookie存在確認
        $aname = Cookie::get("aname");
        $mflag = Cookie::get("mflag");
        $id_token = Cookie::get("id_token");
        $access_token = Cookie::get("access_token");
        $refresh_token = Cookie::get("refresh_token");
        $answer = [
            "an" => $aname,
            "m" => $mflag,
            "i" => $id_token,
            "ac" => $access_token,
            "r" => $refresh_token,
        ];
        if(!isset($aname, $mflag, $id_token, $access_token, $refresh_token)){
            $formatter = new ApiResponseFormatter(
                401,'ログインしてください', 'Cookie Required Information Lost'
            );
            $this->set_cookie->deleteCookie();
            return response()->json($formatter->getResponseArray());
        }
    
        //IDトークンデコード
        $jwt_verifier = new JwtVerifier;
        $jwt_decode = $jwt_verifier->decode($id_token);
        $time = time();

        //IDトークン検証
        if(
            $jwt_decode->aud == config('cognito.clientId') && 
            $jwt_decode->token_use == 'id' && 
            strpos($jwt_decode->iss, config('cognito.region')) !== false && 
            strpos($jwt_decode->iss, config('cognito.poolId')) !== false &&
            $jwt_decode->auth_time <= $time &&
            $jwt_decode->iat <= $time &&
            $jwt_decode->exp >= $time
        ){
            return $next($request);
        }else{
            $formatter = new ApiResponseFormatter(
                401,'ログインしてください', 'IdToken Verifier Failed'
            );
            $this->set_cookie->deleteCookie();
            return response()->json($formatter->getResponseArray());
        }
    }
}