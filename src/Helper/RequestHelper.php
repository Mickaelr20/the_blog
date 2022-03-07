<?php

namespace App\Helper;

class RequestHelper
{

    public function __construct()
    {
        $this->request_server = $_SERVER ?? [];
        $this->request_files = $_FILES ?? [];
        $this->request_get = $_GET ?? [];
        $this->request_post = $_POST ?? [];
    }

    public function getType(): String
    {
        return !empty($this->request_server['REQUEST_METHOD']) ? $this->request_server['REQUEST_METHOD'] : "none";
    }

    public function getRequestData(): array
    {
        $array = [
            "POST" => $this->request_post,
            "GET" => $this->request_get
        ];

        $request_type = $this->getType();

        $res = !empty($array[$request_type]) ? $array[$request_type] : [];
        if (!empty($this->request_files)) {
            $res['FILES'] = $this->request_files;
        }

        return $res;
    }

    public function getServer(): array
    {
        $server = $this->request_server;
        $res = [
            "REQUEST_URI" => !empty($server['REQUEST_URI']) ? $server['REQUEST_URI'] : "/",
            "REQUEST_METHOD" => !empty($server['REQUEST_METHOD']) ? $server['REQUEST_METHOD'] : "none",
            'HTTP_REFERER' => !empty($server['HTTP_REFERER']) ? $server['HTTP_REFERER'] : ""
        ];
        return $res;
    }

    public function redirect($str, $params = null)
    {
        $url = $str;
        if (!empty($params)) {
            $url .= "?";
        }
        foreach ($params as $key => $value) {
            $url .= "$key=$value";
        }

        header("Location: $url");
    }
}
