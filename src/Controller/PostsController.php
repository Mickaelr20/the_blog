<?php

namespace App\Controller;

use App\Model\Table\PostTable;
use App\Controller\CommentsController;
use App\Model\Table\CommentTable;
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
        if (!is_numeric($page) || $page < 0) {
            $page = 0;
        }

        $postTable = new PostTable();
        $liste_posts = $postTable->liste($page);

        // $this->debug("liste posts", $liste_posts);

        $nb_total_posts = $postTable->count();
        $nb_page_max = ceil($nb_total_posts / 5);

        $this->renderer->render("index", [
            "title" => "Publications",
            "liste_posts" => $liste_posts,
            'actual_page' => $page,
            'nb_total_posts' => $nb_total_posts,
            'nb_page_max' => $nb_page_max,
            'base_link' => "/publications/"
        ]);
    }

    public function view($params)
    {
        $id = $params["id"];
        $comment_page = $params['comment_page'];

        $post = new PostEntity();
        $nb_page_max = 0;
        if (is_numeric($id) && $id >= 0) {
            $postTable = new PostTable();
            $post = $postTable->get($id);

            if (!is_numeric($comment_page) || $comment_page < 0) {
                $comment_page = 0;
            }

            $commentsController = new CommentsController();
            $post->comments = $commentsController->listeForPost($id, $comment_page);

            $nb_total_comments_for_post = $commentsController->countForPost($id);
            $nb_page_max = ceil($nb_total_comments_for_post / 5);
        }

        $this->renderer->render("view", [
            "title" => "Publication",
            "post" => $post,
            'nb_page_comments_max' => $nb_page_max,
            'actual_comments_page' => $comment_page,
            'base_comments_link' => "/publication/$id/"
        ]);
    }
}
