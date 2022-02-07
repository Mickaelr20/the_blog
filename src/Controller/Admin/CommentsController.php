<?php

namespace App\Controller\Admin;

use \App\Controller\AppController;
use App\Model\Entity\CommentEntity;
use App\Model\Table\CommentTable;

class CommentsController extends AppController
{

    public function __construct()
    {
        parent::__construct("Comments", "Admin");
    }

    public function index($params)
    {
        $page = $params["page"];

        $liste_comments = [];
        if (!is_numeric($page) || $page < 0) {
            $page = 0;
        }

        $commentTable = new CommentTable();
        $liste_comments = $commentTable->liste($page);
        $nb_total_comments = $commentTable->count();
        $nb_page_max = ceil($nb_total_comments / 5);

        $this->renderer->render("index", [
            "title" => "Commentaires",
            "liste_comments" => $liste_comments,
            'actual_page' => $page,
            'nb_total_comments' => $nb_total_comments,
            'nb_page_max' => $nb_page_max,
            'base_link' => "/admin/comments/"
        ]);
    }

    public function edit($params)
    {
        $comment_id = $params['comment_id'];
        $errors = [];
        $form = [];
        $commentEntity = new CommentEntity();

        if ($this->request->getServer()["REQUEST_METHOD"] === "POST") {
            $form = $this->request->getRequestData();
            $csrfCheckResult = $this->checkCsrfToken();
            if (!$csrfCheckResult) {
                $errors[] = "Le token csrf ne correspond pas, veuillez réessayer.";
            }

            if (empty($errors)) {
                $commentEntity = CommentEntity::fromArray($form);
                $errors = $commentEntity->verifyEntity("update");

                if (empty($errors)) {
                    if (empty($commentEntity->is_validated) || !filter_var($commentEntity->is_validated, FILTER_VALIDATE_BOOLEAN)) {
                        $commentEntity->is_validated = false;
                    }

                    try {
                        $commentTable = new CommentTable();
                        $commentTable->update($commentEntity);
                        header('Location: ' . "/admin/comments/edit/$commentEntity->id?editState=success");
                    } catch (\Exception $e) {
                        $errors[] = "Une erreure est survenue, veuillez réessayer ultérieurement.";
                    }
                }
            }
        } else if ($this->request->getServer()["REQUEST_METHOD"] === "GET") {
            $commentTable = new CommentTable();
            $form = $commentTable->getForEdit($comment_id);
        }

        $this->renderer->render("edit", ["title" => "Modifier un commentaire", "errors" => $errors, "form" => $form]);
    }

    public function delete($params)
    {
        $comment_id = $params['comment_id'];
        $comment = [];
        $errors = [];
        $serverRequestMethod = $this->request->getServer()["REQUEST_METHOD"];

        if ($serverRequestMethod === "POST") {
            $csrfCheckResult = $this->checkCsrfToken();
            if (!$csrfCheckResult) {
                $errors[] = "Le token csrf ne correspond pas, veuillez réessayer.";
            }

            if (empty($errors)) {
                $form = $this->request->getRequestData();

                if (is_numeric($form['action'])) {
                    $action = $form['action'];

                    switch ($action) {
                        case "0": //ne pas supprimer
                            header('Location: ' . "/admin/comments");
                            break;
                        case "1": //supprimer
                            $commentTable = new CommentTable();
                            $commentTable->delete($comment_id);
                            header('Location: ' . "/admin/comments/deleted_comment/$comment_id");
                            break;
                    }
                }
            }
        } else if ($serverRequestMethod === "GET") {
            $commentTable = new CommentTable();
            $comment = $commentTable->get($comment_id);
            if (empty($comment)) {
                $errors[] = "Le commentaire $comment_id n'existe pas.";
            }
        }

        $this->renderer->render("delete", ["title" => "Supprimer un commentaire", "errors" => $errors, "comment" => $comment]);
    }

    public function deleted_comment($params)
    {
        $comment_id = $params['comment_id'];
        $this->renderer->render("deleted_comment", ["title" => "Commentaire supprimé", "deleted_comment_id" => $comment_id]);
    }
}
