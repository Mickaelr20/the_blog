<?php

namespace App\Controller\Admin;

use \App\Controller\AppController;
use App\Model\Entity\PostEntity;
use App\Model\Table\PostTable;
use App\Model\Entity\ImageEntity;
use App\Model\Table\ImageTable;
use App\Helper\UploadHelper;

class PostsController extends AppController
{

    public function __construct()
    {
        parent::__construct("Posts", "Admin");
        $this->uploadHelper = new UploadHelper(new ImageTable(), "image");
        $this->uploadHelper->setPossibleTypes(["image/jpeg", "image/jpg", "image/png"]);
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
            $csrfCheckResult = $this->checkCsrfToken();

            if (!$csrfCheckResult) {
                $errors[] = "Le token csrf ne correspond pas, veuillez réessayer.";
            }

            if (empty($requestData['FILES'])) {
                $errors[] = "Aucune données envoyés";
            }

            if (empty($errors)) {
                $postEntity->patchEntity($requestData);
                $errors = $postEntity->verifyEntity("create");

                if (empty($errors)) {
                    $postEntity->image->completeEntity($requestData['FILES']['image']['name']);
                    $errors = $this->uploadHelper->create($postEntity->image, $postEntity->image->getFullPath());

                    if (empty($errors)) {
                        try {
                            $postEntity->image_id = $postEntity->image->id;
                            $postTable = new PostTable();
                            $postTable->save($postEntity);
                            $this->request->redirect("/admin/posts/edit/$postEntity->id", ["saveState" => "success"]);
                        } catch (\Exception $e) {
                            $errors[] = "Une erreure est survenue, veuillez réessayer ultérieurement.";
                        }
                    }
                }
            }
        }

        $this->renderer->render("new", ["title" => "Nouvelle publication", "errors" => $errors, "form" => $requestData]);
    }

    public function edit_image()
    {
        $errors = [];
        $form = [];
        $newImageEntity = new ImageEntity();

        if ($this->request->getServer()["REQUEST_METHOD"] === "POST") {
            $csrfCheckResult = $this->checkCsrfToken();
            if (!$csrfCheckResult) {
                $errors[] = "Le token csrf ne correspond pas, veuillez réessayer.";
            }

            if (empty($errors)) {
                $form = $this->request->getRequestData();
                $newImageEntity->patchEntity($form);
                $newImageEntity->completeEntity($form['FILES']['image']['name']);
                $newImageEntity->id = null;
                $errors = $newImageEntity->verifyEntity("create");

                if (empty($errors)) {
                    $errors = $this->uploadHelper->create($newImageEntity, $newImageEntity->getFullPath());

                    if (empty($errors)) {
                        $postTable = new PostTable();
                        $postEntity = $postTable->get($form['post_id']);
                        $oldImageEntity = $postEntity->image;
                        $postEntity->setImage($newImageEntity);

                        try {
                            $postTable = new PostTable();
                            $postTable->update($postEntity);
                        } catch (\Exception $e) {
                            $errors[] = "Une erreure est survenue lors de la sauvegarde de la publication, veuillez réessayer ultérieurement.";
                        }

                        if (empty($errors)) {
                            if (!empty($oldImageEntity)) {
                                $errors = $this->uploadHelper->delete($oldImageEntity, $oldImageEntity->getFullPath());
                            }
                        }
                    }
                }
            }
        }

        if (empty($errors)) {
            $this->request->redirect("/admin/posts/edit/{$form['post_id']}", ["editState" => "success"]);
        }

        $this->renderer->render("edit", ["title" => "Modifier une publication", "errors" => $errors, "form" => $form]);
    }

    public function edit($params)
    {
        $post_id = $params['post_id'];
        $errors = [];
        $form = [];
        $postEntity = new PostEntity();

        if ($this->request->getServer()["REQUEST_METHOD"] === "POST") {
            $csrfCheckResult = $this->checkCsrfToken();
            if (!$csrfCheckResult) {
                $errors[] = "Le token csrf ne correspond pas, veuillez réessayer.";
            }
            if (empty($errors)) {
                $form = $this->request->getRequestData();
                $postEntity->patchEntity($form);
                $errors = $postEntity->verifyEntity("update");

                if (empty($errors)) {
                    try {
                        $postTable = new PostTable();
                        $postTable->update($postEntity);
                        $this->request->redirect("/admin/posts/edit/$postEntity->id", ["editState" => "success"]);
                    } catch (\Exception $e) {
                        $errors[] = "Une erreure est survenue, veuillez réessayer ultérieurement.";
                    }
                }
            }
        } else if ($this->request->getServer()["REQUEST_METHOD"] === "GET") {
            $postTable = new PostTable();
            $form = $postTable->get($post_id);
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
                            $this->request->redirect("/admin/posts");

                            break;
                        case "1": //supprimer
                            $postTable = new PostTable();
                            $postEntity = $postTable->get($post_id);
                            $postTable->delete($post_id);
                            $imageTable = new ImageTable();
                            $imageEntity = $imageTable->get($postEntity->image_id);
                            $this->uploadHelper->delete($imageEntity, $imageEntity->getFullPath());

                            $this->request->redirect("/admin/posts/deleted_post/$post_id");

                            break;
                    }
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
