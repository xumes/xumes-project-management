<?php
/**
 * Created by PhpStorm.
 * User: Reginaldo
 * Date: 21/03/2016
 * Time: 23:38
 */

namespace CodeProject\OAuth;
use Illuminate\Support\Facades\Auth;


class Verifier
{
    public function verify($username, $password)
    {
        $credentials = [
            'email'    => $username,
            'password' => $password,
        ];

        if (Auth::once($credentials)) {
            return Auth::user()->id;
        }

        return false;
    }
}