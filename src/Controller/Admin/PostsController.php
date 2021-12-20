<?php

namespace App\Controller\Admin;

use \App\Controller\AppController;
use App\Model\Entity\PostEntity;
use App\Model\Table\PostTable;
use App\Model\Entity\ImageEntity;
use App\Model\Table\ImageTable;

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

            // $this->debug("requestData", $requestData);

            $postEntity = PostEntity::fromArray($requestData);
            // $this->debug("post entity", $postEntity);

            // return;
            $errors = $postEntity->verifyEntity("create");

            if (empty($errors)) {
                $postEntity->image->completeEntity($_FILES['image']['name']);
                $errors = $this->trySaveImage($postEntity->image);
                // $this->debug("post entity", $postEntity);
                // return;

                if (empty($errors)) {
                    try {
                        $postEntity->image_id = $postEntity->image->id;
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
        }
        $this->renderer->render("new", ["title" => "Nouvelle publication", "errors" => $errors, "form" => $requestData]);
    }

    private function trySaveImage(ImageEntity $imageEntity)
    {
        $errors = [];

        try {
            $imageTable = new ImageTable();
            $imageTable->save($imageEntity);
        } catch (\Exception $e) {
            $this->debug("exception - save image", $e);
            $error = "Une erreure est survenue lors de la sauvegarde de l'image, veuillez réessayer ultérieurement.";
            switch ($e->getCode()) {
            }

            $errors[] = $error;
        }

        if (empty($errors)) {
            $tmpName = $_FILES['image']['tmp_name'];

            try {
                move_uploaded_file($tmpName, $imageEntity->path . $imageEntity->file_name);
            } catch (\Exception $e) {
                $errors[] = "Impossible d'ajouter l'image sur le disque.";

                try {
                    $imageTable = new ImageTable();
                    $imageTable->delete($imageEntity->id);
                } catch (\Exception $e) {
                    $error = "Une erreure est survenue lors de la sauvegarde de l'image, veuillez réessayer ultérieurement.";
                    switch ($e->getCode()) {
                    }

                    $errors[] = $error;
                }
            }
        }

        return $errors;
    }

    private function tryDeleteImage(ImageEntity $imageEntity)
    {
        $errors = [];

        try {
            $imageTable = new ImageTable();
            if (!empty($imageEntity->id)) {
                $imageTable->delete($imageEntity->id);
            }
        } catch (\Exception $e) {
            $error = "Une erreure est survenue lors de la suppression de l'image, veuillez réessayer ultérieurement.";
            switch ($e->getCode()) {
            }

            $errors[] = $error;
        }

        if (empty($errors)) {
            // $this->debug("post entity - DEBUG", $imageEntity->getFullPath());
            if (file_exists($imageEntity->getFullPath())) {
                unlink($imageEntity->getFullPath());
            } else {
            }
        }

        return $errors;
    }

    public function edit_image()
    {
        $errors = [];
        $form = [];
        $newImageEntity = new ImageEntity();

        if ($this->request->getServer()["REQUEST_METHOD"] === "POST") {
            $form = $this->request->getRequestData();
            $newImageEntity = ImageEntity::fromArray($form);
            // $this->debug("Formulaire", $form);

            $newImageEntity->completeEntity($_FILES['image']['name']);
            $newImageEntity->id = null;
            // $this->debug("New image entity", $newImageEntity);

            $errors = $newImageEntity->verifyEntity("create");
            // $this->debug("Errors", $errors);

            $imageTable = new ImageTable();

            if (empty($errors)) {
                // $imageTable->save($imageEntity);
                $errors = $this->trySaveImage($newImageEntity);
                // $this->debug("Errors try save image", $errors);
                // $this->debug("New image entity after save", $newImageEntity);

                // $this->debug("Image entity full path", "");

                // return;

                $postTable = new PostTable();
                $postEntity = $postTable->get($form['post_id']);
                $oldImageEntity = $postEntity->image;
                // $this->debug("Post entity", $postEntity);

                $postEntity->setImage($newImageEntity);
                // $this->debug("Post entity - after set new image", $postEntity);

                try {
                    $postTable = new PostTable();
                    $postTable->update($postEntity);
                } catch (\Exception $e) {
                    $this->debug("exception - save post", $e);
                    $error = "Une erreure est survenue lors de la sauvegarde de l'image, veuillez réessayer ultérieurement.";
                    switch ($e->getCode()) {
                    }

                    $errors[] = $error;
                }

                if (empty($errors)) {
                    if (!empty($oldEntity)) {
                        // $this->debug("Old image entity", $oldImageEntity);
                        $errors = $this->tryDeleteImage($oldImageEntity);
                    }
                }

                $this->debug("Post entity - after update", $postEntity);
            }
        }

        if (empty($errors)) {
            header('Location: ' . "/admin/posts/edit/$postEntity->id?editState=success");
        }
    }

    public function edit($params)
    {
        $post_id = $params['post_id'];
        $errors = [];
        $form = [];
        $postEntity = new PostEntity();

        if ($this->request->getServer()["REQUEST_METHOD"] === "POST") {
            $form = $this->request->getRequestData();
            $postEntity = PostEntity::fromArray($form);
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
            $form = $postTable->get($post_id);

            // $imageTable = new ImageTable();
            // $form->image = $imageTable->get($form->image_id);
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


            if (is_numeric($form['action'])) {
                $action = $form['action'];

                switch ($action) {
                    case "0": //ne pas supprimer
                        header('Location: ' . "/admin/posts");
                        break;
                    case "1": //supprimer
                        $postTable = new PostTable();
                        $postEntity = $postTable->get($post_id);
                        $postTable->delete($post_id);
                        $imageTable = new ImageTable();
                        $imageEntity = $imageTable->get($postEntity->image_id);
                        $this->tryDeleteImage($imageEntity);

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
        $this->renderer->render("deleted_post", ["title" => "Publication supprimé", "deleted_post_id" => $post_id]);
    }
}
