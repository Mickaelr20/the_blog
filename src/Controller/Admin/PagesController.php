<?php

namespace App\Controller\Admin;

use \App\Controller\AppController;

class PagesController extends AppController
{

    public function __construct()
    {
        parent::__construct("Pages", "Admin");
    }

    public function display($params)
    {
        $this->renderer->render($params['page'], ["title" => "Accueil"]);
    }
}
