<?php

namespace App\Controller;

use App\Helper\{RequestHelper, Renderer};

class AppController
{
    protected $renderer;
    protected $request;

    public function __construct($modele, $namespace = "")
    {
        $this->renderer = new Renderer($modele, $namespace);
        $this->request = new RequestHelper();
    }

    public function __call($name, $args)
    {
        if (method_exists($this, $name)) {
            $this->$name($args);
        } else {
            throw new \Exception('L\'action ' . $name . ' n\'exsite pas.');
        }
    }
}
