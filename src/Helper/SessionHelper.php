<?php

namespace App\Helper;

class SessionHelper
{

    public function __construct()
    {
        $this->session = !empty($_SESSION) ? $_SESSION : [];
    }

    public function put($key, $value)
    {
        $this->session[$key] = $value;
    }

    public function get($key)
    {
        return (!empty($this->session[$key]) ? $this->session[$key] : null);
    }

    public function remove($key)
    {
        unset($this->session[$key]);
    }

    public function generateNewToken()
    {
        $newToken = $this->generateRandomString(32);
        $this->put("csrf_token", $newToken);
    }

    private function generateRandomString($length = 10)
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
