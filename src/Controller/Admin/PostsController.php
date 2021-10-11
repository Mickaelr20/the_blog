<?php

namespace App\Controller\Admin;

use \App\Controller\AppController;
use App\Model\Entity\PostEntity;
use App\Model\Table\PostTable;

class PostsController extends AppController
{

    public function __construct()
    {
        parent::__construct("Posts", "Admin");
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
        $nb_total_posts = $postTable->count();
        $nb_page_max = ceil($nb_total_posts / 5);

        $this->renderer->render("index", [
            "title" => "Publications",
            "liste_posts" => $liste_posts,
            'actual_page' => $page,
            'nb_total_posts' => $nb_total_posts,
            'nb_page_max' => $nb_page_max,
            'base_link' => "/admin/posts/"
        ]);
    }

    public function new()
    {
        $errors = [];
        $requestData = [];
        $postEntity = new PostEntity();

        if ($this->request->getServer()["REQUEST_METHOD"] === "POST") {
            $requestData = $this->request->getRequestData();
            $postEntity->fromArray($requestData);
            $errors = $postEntity->verifyEntity("create");

            if (empty($errors)) {
                try {
                    $postTable = new PostTable();
                    $postTable->save($postEntity);
                    header('Location: ' . "/admin/posts/edit/$postEntity->id?saveState=success");
                } catch (\Exception $e) {
                    $error = "Une erreure est survenue, veuillez réessayer ultérieurement.";
                    switch ($e->getCode()) {
                    }

                    $errors[] = $error;
                }
            }
        }

        $this->renderer->render("new", ["title" => "Nouvelle publication", "errors" => $errors, "form" => $requestData]);
    }

    public function edit($params)
    {
        $post_id = $params['post_id'];
        $errors = [];
        $form = [];
        $postEntity = new PostEntity();

        if ($this->request->getServer()["REQUEST_METHOD"] === "POST") {
            $form = $this->request->getRequestData();
            $postEntity->fromArray($form);
            $errors = $postEntity->verifyEntity("update");

            if (empty($errors)) {
                try {
                    $postTable = new PostTable();
                    $postTable->update($postEntity);
                    header('Location: ' . "/admin/posts/edit/$postEntity->id?editState=success");
                } catch (\Exception $e) {
                    $error = "Une erreure est survenue, veuillez réessayer ultérieurement.";
                    switch ($e->getCode()) {
                    }

                    $errors[] = $error;
                    // var_dump($e);
                    // var_dump($postEntity->toArray());
                }
            }
        } else if ($this->request->getServer()["REQUEST_METHOD"] === "GET") {
            $postTable = new PostTable();
            $form = $postTable->getForEdit($post_id);
        }

        $this->renderer->render("edit", ["title" => "Modifier une publication", "errors" => $errors, "form" => $form]);
    }

    public function delete($params)
    {
        $post_id = $params['post_id'];
        $post = [];
        $errors = [];
        $serverRequestMethod = $this->request->getServer()["REQUEST_METHOD"];

        if ($serverRequestMethod === "POST") {
            $form = $this->request->getRequestData();

            var_dump($form);

            if (is_numeric($form['action'])) {
                $action = $form['action'];

                switch ($action) {
                    case "0": //ne pas supprimer
                        header('Location: ' . "/admin/posts");
                        break;
                    case "1": //supprimer
                        $postTable = new PostTable();
                        $postTable->delete($post_id);
                        header('Location: ' . "/admin/posts/deleted_post/$post_id");
                        break;
                }
            }
        } else if ($serverRequestMethod === "GET") {
            $postTable = new PostTable();
            $post = $postTable->get($post_id);
            if (empty($post)) {
                $errors[] = "La publication $post_id n'existe pas.";
            }
        }

        $this->renderer->render("delete", ["title" => "Supprimer une publication", "errors" => $errors, "post" => $post]);
    }

    public function deleted_post($params)
    {
        $post_id = $params['post_id'];
        var_dump($post_id);
        $this->renderer->render("deleted_post", ["title" => "Publication supprimé", "deleted_post_id" => $post_id]);
    }
}
