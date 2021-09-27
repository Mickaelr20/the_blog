<?php

namespace App\Controller;

use App\Model\Table\PostTable;
use App\Model\Entity\PostEntity;

class PostsController extends AppController
{

    public function __construct()
    {
        parent::__construct("Posts");
    }

    public function index($page)
    {

        $postTable = new PostTable();
        $liste_posts = $postTable->liste($page);

        $this->renderer->render("index", ["title" => "Publications", "liste_posts" => $liste_posts]);
    }
}
