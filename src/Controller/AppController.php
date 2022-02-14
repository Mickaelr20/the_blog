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
    }

    public function call($name, $args)
    {
        if (!method_exists($this, $name)) {
            throw new \Exception('L\'action ' . $name . ' n\'exsite pas.');
        }

        $this->$name($args);
    }

    public function debug($str, $toDump)
    {
        echo nl2br("\n$str:\n");
        var_dump($toDump);
        echo nl2br("\n\n");
    }

    public function checkCsrfToken(): bool
    {
        $result = false;
        $requestData = $this->request->getRequestData();

        if (!empty($requestData['csrf_token'])) {
            $result = $requestData['csrf_token'] === SessionHelper::get('csrf_token');
        }

        return $result;
    }

    public function sendMail()
    {
        // Create the Transport
        $transport = (new \Swift_SmtpTransport('smtp.example.org', 25))
            ->setUsername('your username')
            ->setPassword('your password');
    }
}
