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
        return (isset($_SESSION[$key]) ? $_SESSION[$key] : null);
    }

    public static function remove($key)
    {
        unset($_SESSION[$key]);
    }
}
