<?php

namespace App\Helper;

class SessionHelper
{
    public function put($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public function get($key)
    {
        return (!empty($_SESSION[$key]) ? $_SESSION[$key] : null);
    }

    public function remove($key)
    {
        unset($_SESSION[$key]);
    }
}
