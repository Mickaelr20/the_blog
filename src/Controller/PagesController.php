<?php

namespace App\Controller;

class PagesController extends AppController
{

    public function __construct()
    {
        parent::__construct("Pages");
    }

    public function display($params)
    {
        $this->renderer->layout = $params['layout'];
        $this->renderer->render($params['page'], ["title" => $params['title'], "active_link_name" => $params['active_link_name'] ?? null]);
    }
}
