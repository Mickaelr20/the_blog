<?php

namespace App\Helper;

class RequestHelper
{
    var $post_vars;
    var $get_vars;

    public function __construct()
    {
        $this->get_vars = $_GET;
        $this->post_vars = $_POST;
    }

    public function getType(): String
    {
        return !empty($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : "none";
    }

    public function getRequestData(): array
    {
        $post = !empty($this->post_vars) ? $this->post_vars : [];
        $get = !empty($this->get_vars) ? $this->get_vars : [];

        $request_type = strtolower($this->getType());

        return !empty($$request_type) ? $$request_type : [];
    }

    public function getServer(): array
    {
        $server = !empty($_SERVER) ? $_SERVER : [];
        $res = [
            "REQUEST_URI" => !empty($server['REQUEST_URI']) ? $server['REQUEST_URI'] : "/",
            "REQUEST_METHOD" => !empty($server['REQUEST_METHOD']) ? $server['REQUEST_METHOD'] : "none"
        ];
        return $res;
    }
}
