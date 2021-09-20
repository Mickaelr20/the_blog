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
        $this->renderer->render($params['page'], ["title" => "Acceuil"]);
    }
}
