<?php

namespace App\Controller\Admin;

use \App\Controller\AppController;
use App\Model\Entity\UserEntity;
use App\Model\Table\UserTable;

class UsersController extends AppController
{

    public function __construct()
    {
        parent::__construct("Users", "Admin");
    }

    public function index($params)
    {
        $page = $params["page"];

        $listeUsers = [];
        if (!is_numeric($page) || $page < 0) {
            $page = 0;
        }

        $userTable = new UserTable();
        $listeUsers = $userTable->liste($page);
        $nb_total_users = $userTable->count();
        $nbPageMax = ceil($nb_total_users / 5);

        $this->renderer->render("index", [
            "title" => "Publications",
            "listeUsers" => $listeUsers,
            'actualPage' => $page,
            'nb_total_users' => $nb_total_users,
            'nbPageMax' => $nbPageMax,
            'baseLink' => "/admin/users/"
        ]);
    }

    public function new()
    {
        $errors = [];
        $requestData = [];
        $userEntity = new UserEntity();

        if ($this->request->getServer()["REQUEST_METHOD"] === "POST") {
            $requestData = $this->request->getRequestData();
            $userEntity->patchEntity($requestData);
            $errors = $userEntity->verifyEntity("create");

            if (empty($errors)) {
                try {
                    $userTable = new UserTable();
                    $userTable->save($userEntity);
                    $this->request->redirect("/admin/users/edit/$userEntity->id", ["saveState" => "success"]);
                } catch (\Exception $e) {
                    $errors[] = "Une erreure est survenue, veuillez réessayer ultérieurement.";
                }
            }
        }

        $this->renderer->render("new", ["title" => "Nouvel utilisateur", "errors" => $errors, "form" => $requestData]);
    }

    public function edit($params)
    {
        $user_id = $params['user_id'];
        $errors = [];
        $form = [];
        $userEntity = new UserEntity();

        if ($this->request->getServer()["REQUEST_METHOD"] === "POST") {
            $form = $this->request->getRequestData();
            $userEntity->patchEntity($form);
            $errors = $userEntity->verifyEntity("update");

            if (empty($errors)) {
                if (empty($userEntity->is_validated) || !filter_var($userEntity->is_validated, FILTER_VALIDATE_BOOLEAN)) {
                    $userEntity->is_validated = false;
                }

                try {
                    $userTable = new UserTable();
                    $userTable->update($userEntity);
                    $this->request->redirect("/admin/users/edit/$userEntity->id", ["editState" => "success"]);
                } catch (\Exception $e) {
                    $error = "Une erreure est survenue, veuillez réessayer ultérieurement.";
                    switch ($e->getCode()) {
                        case "23000":
                            $error = "Adresse email déjà utilisé.";
                            break;
                    }

                    $errors[] = $error;
                }
            }
        } else if ($this->request->getServer()["REQUEST_METHOD"] === "GET") {
            $userTable = new UserTable();
            $form = $userTable->getForEdit($user_id);
        }

        $this->renderer->render("edit", ["title" => "Modifier une utilisateur", "errors" => $errors, "form" => $form]);
    }

    public function delete($params)
    {
        $user_id = $params['user_id'];
        $user = [];
        $errors = [];
        $serverRequestMethod = $this->request->getServer()["REQUEST_METHOD"];

        if ($serverRequestMethod === "POST") {
            $form = $this->request->getRequestData();

            if (is_numeric($form['action'])) {
                $action = $form['action'];

                switch ($action) {
                    case "0": //ne pas supprimer
                        $this->request->redirect("/admin/users");

                        break;
                    case "1": //supprimer
                        $userTable = new UserTable();
                        $userTable->delete($user_id);
                        $this->request->redirect("/admin/users/deleted_user/$user_id");

                        break;
                }
            }
        } else if ($serverRequestMethod === "GET") {
            $userTable = new UserTable();
            $user = $userTable->get($user_id);
            if (empty($user)) {
                $errors[] = "L'utilisateur $user_id n'existe pas.";
            }
        }

        $this->renderer->render("delete", ["title" => "Supprimer un utilisateur", "errors" => $errors, "userToDelete" => $user]);
    }

    public function deleted_user($params)
    {
        $user_id = $params['user_id'];
        $this->renderer->render("deleted_user", ["title" => "Publication supprimé", "deletedUserId" => $user_id]);
    }
}
