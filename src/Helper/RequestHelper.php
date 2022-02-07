<?php

namespace App\Helper;

class RequestHelper
{
    public function getType(): String
    {
        return !empty($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : "none";
    }

    public function getRequestData(): array
    {
        $super_files = $_FILES;
        $super_get = $_GET;
        $super_post = $_POST;

        $array = [
            "POST" => !empty($super_post) ? $super_post : [],
            "GET" => !empty($super_get) ? $super_get : []
        ];

        if (!empty($super_files)) {
            $array['FILES'] = $super_files;
        }

        $request_type = $this->getType();

        return !empty($array[$request_type]) ? $array[$request_type] : [];
    }

    public function getServer(): array
    {
        $server = !empty($_SERVER) ? $_SERVER : [];
        $res = [
            "REQUEST_URI" => !empty($server['REQUEST_URI']) ? $server['REQUEST_URI'] : "/",
            "REQUEST_METHOD" => !empty($server['REQUEST_METHOD']) ? $server['REQUEST_METHOD'] : "none",
            'HTTP_REFERER' => !empty($server['HTTP_REFERER']) ? $server['HTTP_REFERER'] : ""
        ];
        return $res;
    }
}
