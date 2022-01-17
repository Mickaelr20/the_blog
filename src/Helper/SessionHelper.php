<?php

namespace App\Helper;

class SessionHelper
{
    public static function put($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public static function get($key)
    {
        return (!empty($_SESSION[$key]) ? $_SESSION[$key] : null);
    }

    public static function remove($key)
    {
        unset($_SESSION[$key]);
    }

    public static function generateNewToken()
    {
        $newToken = SessionHelper::generateRandomString(32);
        SessionHelper::put("csrf_token", $newToken);
    }

    private static function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
