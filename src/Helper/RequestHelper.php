<?php

namespace App\Helper;

class RequestHelper
{

    public function __construct()
    {
        $this->requestServer = !empty($_SERVER) ? $_SERVER : [];
        $this->requestFiles = !empty($_FILES) ? $_FILES : [];
        $this->requestGet = !empty($_GET) ? $_GET : [];
        $this->requestPost = !empty($_POST) ? $_POST : [];
    }

    public function getType(): String
    {
        return !empty($this->requestServer['REQUEST_METHOD']) ? $this->requestServer['REQUEST_METHOD'] : "none";
    }

    public function getRequestData(): array
    {
        $array = [
            "POST" => $this->requestPost,
            "GET" => $this->requestGet
        ];

        $requestType = $this->getType();

        $res = !empty($array[$requestType]) ? $array[$requestType] : [];
        if (!empty($this->requestFiles)) {
            $res['FILES'] = $this->requestFiles;
        }

        return $res;
    }

    public function getServer(): array
    {
        $server = $this->requestServer;
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
