<?php

namespace App\Controller\Admin;

use \App\Controller\AppController;

class PostsController extends AppController
{

    public function __construct()
    {
        parent::__construct("Posts", "Admin");
    }

    public function index()
    {

        $this->renderer->render("index", ["title" => "Publications"]);
    }
}
