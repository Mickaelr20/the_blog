<?php

namespace App\Controller;

use App\Model\Table\UserTable;
use App\Model\Entity\UserEntity;
use App\Helper\SessionHelper;

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

        if ($this->request->getType() === "POST") {
            $csrfCheckResult = $this->checkCsrfToken();
            if (!$csrfCheckResult) {
                $errors[] = "Le token csrf ne correspond pas, veuillez réessayer.";
            }

            $form = $this->request->getRequestData();
            if (empty($errors)) {
                if (empty($form['email'])) {
                    $errors[] = "Veuillez précisé une adresse email.";
                }

                if (empty($form['password'])) {
                    $errors[] = "Veuillez précisé un mot de passe.";
                }
            }

            if (empty($errors)) {
                try {
                    $userTable = new UserTable();
                    $user = $userTable->getForLogin($form['email']);
                    $passwordVerified = password_verify($form['password'], $user->password);
                    $errors[] = "Mot de passe incorrecte.";

                    if ($passwordVerified) {
                        $session = new SessionHelper();
                        $session->put("user", $user->toArray());
                        $this->request->redirect("/users/login_success");
                    }
                } catch (\Exception $e) {
                    $errors[] = "Une erreure est survenue, veuillez réessayer ultérieurement.";
                }
            }
        }

        $this->renderer->render("login", ["title" => "Connexion", "errors" => $errors, "form" => $form]);
    }

    public function signup()
    {
        $errors = [];
        $requestData = [];
        $userEntity = new UserEntity();

        if ($this->request->getType() === "POST") {
            $csrfCheckResult = $this->checkCsrfToken();
            if (!$csrfCheckResult) {
                $errors[] = "Le token csrf ne correspond pas, veuillez réessayer.";
            }

            if (empty($errors)) {
                $requestData = $this->request->getRequestData();
                $userEntity->patchEntity($requestData);
                $errors = $userEntity->verifyEntity();

                if (empty($errors)) {
                    $userEntity = $userEntity->securize();

                    try {
                        $userTable = new UserTable();
                        $userTable->save($userEntity);
                        $this->request->redirect("/users/signup_success");
                    } catch (\Exception $e) {
                        $error = "Une erreure est survenue, veuillez réessayer ultérieurement.";
                        switch ($e->getCode()) {
                            case "23000":
                                $error = "Adresse email ou pseudo déjà utilisé.";
                                break;
                        }

                        $errors[] = $error;
                    }
                }
            }
        }

        $this->renderer->render("signup", ["title" => "Inscription", "errors" => $errors, "form" => $requestData]);
    }

    public function signup_success()
    {
        $this->renderer->render("signup_success", ['title' => "Inscription effectué"]);
    }

    public function login_success()
    {
        $this->renderer->render("login_success");
    }

    public function logout()
    {
        session_destroy();
        $this->request->redirect("/");
    }
}
