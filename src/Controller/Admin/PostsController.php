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
        $server_request_method = $_SERVER['REQUEST_METHOD'];

        if (!empty($server_request_method) && $server_request_method === "POST") {
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
