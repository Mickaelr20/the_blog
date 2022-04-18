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

        $listePosts = [];
        if (!is_numeric($page) || $page < 0) {
            $page = 0;
        }

        $postTable = new PostTable();
        $listePosts = $postTable->liste($page);

        $nbTotalPosts = $postTable->count();
        $nbPageMax = ceil($nbTotalPosts / 5);

        $this->renderer->render("index", [
            "title" => "Publications",
            "listePosts" => $listePosts,
            'actualPage' => $page,
            'nbTotalPosts' => $nbTotalPosts,
            'nbPageMax' => $nbPageMax,
            'baseLink' => "/publications/",
            'activeLinkBame' => 'posts'
        ]);
    }

    public function view($params)
    {
        $id = $params["id"];
        $commentPage = $params['comment_page'];

        $post = new PostEntity();
        $nbPageMax = 0;

        if (is_numeric($id) && $id >= 0) {
            $postTable = new PostTable();
            $post = $postTable->get($id);

            if (!is_numeric($commentPage) || $commentPage < 0) {
                $commentPage = 0;
            }

            $commentsController = new CommentsController();
            $post->comments = $commentsController->listeForPost($id, $commentPage);

            $nbComments = $commentsController->countForPost($id);
            $nbPageMax = ceil($nbComments / 5);
        }

        $this->renderer->render("view", [
            "title" => "Publication",
            "post" => $post,
            'nbPageCommentsMax' => $nbPageMax,
            'actualCommentsPage' => $commentPage,
            'baseCommentsLink' => "/publication/$id/"
        ]);
    }
}
