<?php

namespace App\Controller;

class ErrorsController extends AppController
{

    public function __construct()
    {
        parent::__construct("Errors");
    }

    public function error($params)
    {
        $this->renderer->render($params['code'], ["title" => "Error", "message" => $params['message']]);
    }
}
