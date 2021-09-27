<?php

namespace App\Controller\Admin;

use \App\Controller\AppController;

class PostsController extends AppController
{

    public function __construct()
    {
        parent::__construct("Posts", "Admin");
    }

    public function index()
    {

        $this->renderer->render("index", ["title" => "Publications"]);
    }

    public function new()
    {
        $errors = [];
        $form = [];

        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $form = $_POST;

            if (!empty($form['email']) && !empty($form['password'])) {
                try {
                    //TODO: save
                } catch (\Exception $e) {
                    $error = "Une erreure est survenue, veuillez réessayer ultérieurement.";
                    switch ($e->getCode()) {
                        case "":
                            break;
                    }

                    $errors[] = $error;
                }
            } else {
            }
        }

        $this->renderer->render("new", ["title" => "Nouvelle publication", "errors" => $errors, "form" => $form]);
    }
}
