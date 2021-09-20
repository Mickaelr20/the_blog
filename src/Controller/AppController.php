<?php

namespace App\Controller;

use App\Helper\{Renderer};

class AppController
{
    protected $renderer;

    public function __construct($modele, $namespace = "")
    {
        $this->renderer = new Renderer($modele, $namespace);
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
