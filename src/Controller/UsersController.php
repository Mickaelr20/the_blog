<?php

namespace App\Controller;

use App\Model\Table\UserTable;
use App\Model\Entity\UserEntity;

class UsersController extends AppController
{

    public function __construct()
    {
        parent::__construct("Users");
    }

    public function login()
    {
        $errors = [];
        $form = [];

        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $form = $_POST;

            if (!empty($form['email']) && !empty($form['password'])) {
                try {
                    $userTable = new UserTable();
                    $rows = $userTable->get($form['email']);
                    $first_user = $rows[0];

                    $password_verified = password_verify($form['password'], $first_user['password']);

                    if ($password_verified) {
                        $_SESSION['user'] = $first_user;
                        header('Location: ' . "/users/login_success");
                    } else {
                        $errors[] = "Mot de passe incorrecte.";
                    }
                } catch (\Exception $e) {
                    $error = "Une erreure est survenue, veuillez réessayer ultérieurement.";
                    switch ($e->getCode()) {
                        case "":
                            break;
                    }

                    $errors[] = $error;
                }
            } else {
                if (empty($form['email'])) {
                    $errors[] = "Veuillez précisé une adresse email.";
                }

                if (empty($form['password'])) {
                    $errors[] = "Veuillez précisé un mot de passe.";
                }
            }
        }

        $this->renderer->render("login", ["title" => "Connexion", "errors" => $errors, "form" => $form]);
    }

    public function signup()
    {
        $errors = [];
        $form = [];
        $userEntity = new UserEntity();

        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $form = $_POST;
            $userEntity->fromArray($form);
            $errors = $userEntity->verifyEntity();

            if (empty($errors)) {
                $userEntity = $userEntity->securize();

                try {
                    $userTable = new UserTable();
                    $userTable->save($userEntity);
                    header('Location: ' . "/users/signup_success");
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
        }

        $this->renderer->render("signup", ["title" => "Inscription", "errors" => $errors, "form" => $form]);
    }

    public function signup_success()
    {
        $this->renderer->render("signup_success");
    }

    public function login_success()
    {
        $this->renderer->render("login_success");
    }

    public function logout()
    {
        session_destroy();
        header("Location: /");
    }
}
