<?php

namespace App\Controller;

use App\Model\Table\{PostTable};
use App\Controller\CommentsController;
use App\Model\Entity\PostEntity;

class PostsController extends AppController
{

    public function __construct()
    {
        parent::__construct("Posts");
    }

    public function index($params)
    {
        $page = $params["page"];

        $liste_posts = [];
        if (is_numeric($page) && $page >= 0) {
            $postTable = new PostTable();
            $liste_posts = $postTable->liste($page);
        }

        $this->renderer->render("index", ["title" => "Publications", "liste_posts" => $liste_posts]);
    }

    public function view($params)
    {
        $id = $params["id"];

        $post = [];
        if (is_numeric($id) && $id >= 0) {
            $postTable = new PostTable();
            $post = $postTable->get($id);
            $commentsController = new CommentsController();
            $post['comments'] = $commentsController->liste($id);
        }

        $this->renderer->render("view", ["title" => "Publication", "post" => $post]);
    }
}
