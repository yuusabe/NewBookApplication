<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function deleteCookie(Request $request)
    {
        setcookie('aname','', time() - 3600, '/');
        setcookie('mflag', '', time() - 3600, '/');
        setcookie('refresh_token', '', time() - 3600, '/');
        setcookie('access_token', '', time() - 3600, '/');
        setcookie('id_token', '', time() - 3600, '/');
        return true;
    }
}
