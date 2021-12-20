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

    public function listeForPost($post_id, $page): array
    {
        $comments = [];
        if (is_numeric($post_id) && $post_id >= 0) {
            $commentTable = new CommentTable();
            $comments = $commentTable->listeForPost($post_id, $page);
        }

        return $comments;
    }


    public function countForPost($post_id): int
    {
        $comments = 0;
        if (is_numeric($post_id) && $post_id >= 0) {
            $commentTable = new CommentTable();
            $comments = $commentTable->countForPost($post_id);
        }

        return $comments;
    }

    public function new()
    {
        $errors = [];
        $requestData = [];
        $commentEntity = new CommentEntity();

        if ($this->request->getServer()["REQUEST_METHOD"] === "POST") {
            $requestData = $this->request->getRequestData();
            $commentEntity = CommentEntity::fromArray($requestData);
            $errors = $commentEntity->verifyEntity("create");

            if (empty($errors)) {
                if (empty($commentEntity->is_validated) || !is_bool($commentEntity->is_validated)) {
                    $commentEntity->is_validated = false;
                }

                try {
                    $commentTable = new CommentTable();
                    $commentTable->save($commentEntity);

                    // var_dump($this->request->getServer()["HTTP_REFERER"]);

                    header('Location: /publication/' . $commentEntity->post_id . "/?saveState=success");
                } catch (\Exception $e) {
                    $error = "Une erreure est survenue, veuillez réessayer ultérieurement.";
                    switch ($e->getCode()) {
                    }

                    $errors[] = $error;
                    var_dump($e);
                }
            }
        }

        $this->renderer->render("new", ["title" => "Commentaire", "errors" => $errors, "form" => $requestData]);
    }
}
