<?php

namespace App\Controller;

use App\Model\Table\CommentTable;
use App\Model\Entity\CommentEntity;

class CommentsController extends AppController
{

    public function __construct()
    {
        parent::__construct("Comments");
    }

    public function liste($post_id): array
    {
        $comments = [];
        if (is_numeric($post_id) && $post_id >= 0) {
            $commentTable = new CommentTable();
            $comments = $commentTable->listeForPost($post_id);
        }

        return $comments;
    }
}
