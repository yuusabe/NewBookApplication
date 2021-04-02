<?php

namespace App\Services;

use Illuminate\Support\Facades\Cookie;
use App\Models\Account;

/**
 * SPAでAPIサーバーからの返却値を整形するためのクラス
 */
class AuthSetCookie
{
    public function loginCookie($auth_result, $email)
    {
        $account = Account::where('logic_flag', true)->where('mail_address', $email)->first();
        
        if($auth_result && $account){
            Cookie::queue("id_token", $auth_result["IdToken"], 60);
            Cookie::queue("access_token", $auth_result["AccessToken"], 60);
            Cookie::queue("refresh_token", $auth_result["RefreshToken"], 60);
            Cookie::queue("aname", $account->account_name, 60);
            if($account->manager_flag == true){
                Cookie::queue("mflag", 1, 60);
            }else{
                Cookie::queue("mflag", 0, 60);
            }
            return true;
        }

        return false;
    }

    public function firstLoginCookie($email, $session)
    {
        if($email && $session){
            Cookie::queue("email", $email);
            Cookie::queue("cognito_session", $session);
            return true;
        }

        return false;
    }

}