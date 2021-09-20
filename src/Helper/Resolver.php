<?php

namespace App\Helper;

class Resolver
{

    var $controllerName;
    var $action;

    public function __construct($controllerName, $action)
    {
        $this->controllerName = "App\Controller\\" . $controllerName;
        $this->action = $action;
    }

    public function resolve($params)
    {
        // try {
        $controller = new $this->controllerName();
        $controller->__call($this->action, $params);
        // } catch (\Exception $e) {
        //     $resolver = new Resolver("ErrorsController", "error");
        //     $resolver->resolve(['code' => '404']);
        // }
    }
}
