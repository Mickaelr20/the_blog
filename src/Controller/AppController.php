<?php

namespace App\Controller;

use App\Helper\{SessionHelper, RequestHelper, Renderer};

class AppController
{
    protected $renderer;
    protected $request;

    public function __construct($modele, $namespace = "")
    {
        $this->renderer = new Renderer($modele, $namespace);
        $this->request = new RequestHelper();
        $this->sessionHelper = new SessionHelper();
    }

    public function call($name, $args)
    {
        if (!method_exists($this, $name)) {
            throw new \Exception('L\'action ' . $name . ' n\'exsite pas.');
        }

        $this->$name($args);
    }

    public function checkCsrfToken(): bool
    {
        $result = false;
        $requestData = $this->request->getRequestData();

        if (!empty($requestData['csrfToken'])) {
            $result = $requestData['csrfToken'] === $this->sessionHelper->get('csrfToken');
        }

        return $result;
    }
}
