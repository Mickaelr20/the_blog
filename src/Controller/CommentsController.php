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

        $csrfCheckResult = $this->checkCsrfToken();
        if (!$csrfCheckResult) {
            $errors[] = "Le token csrf ne correspond pas, veuillez réessayer.";
        }

        if (empty($errors) && $this->request->getType() === "POST") {
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

                    $this->request->redirect("/publication/" . $commentEntity->post_id, ["saveState" => "success"]);
                } catch (\Exception $e) {
                    $errors[] = "Une erreure est survenue, veuillez réessayer ultérieurement.";
                }
            }
        }

        $this->renderer->render("new", ["title" => "Commentaire", "errors" => $errors, "form" => $requestData]);
    }
}
