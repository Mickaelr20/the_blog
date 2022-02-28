<?php

namespace App;

use App\Route;

use App\Helper\RequestHelper;

class Router
{
    private $url;
    private $routes = [];
    private $namedRoutes = [];
    private $request;

    public function __construct($url)
    {
        $this->request = new RequestHelper();
        $this->url = $url;
    }

    public function get($path, $callable, $name = null)
    {
        return $this->add($path, $callable, $name, 'GET');
    }

    public function post($path, $callable, $name = null)
    {
        return $this->add($path, $callable, $name, 'POST');
    }

    public function both($path, $callable, $name = null)
    {
        $this->add($path, $callable, $name, 'GET');
        $this->add($path, $callable, $name, 'POST');
    }

    private function add($path, $callable, $name, $method)
    {
        $route = new Route($path, $callable);
        $this->routes[$method][] = $route;
        if (is_string($callable) && $name === null) {
            $name = $callable;
        }
        if ($name) {
            $this->namedRoutes[$name] = $route;
        }
        return $route;
    }

    public function run()
    {
        if (!isset($this->routes[$this->request->getServer()["REQUEST_METHOD"]])) {
            throw new \Exception('REQUEST_METHOD does not exist');
        }
        foreach ($this->routes[$this->request->getServer()["REQUEST_METHOD"]] as $route) {
            //On enlève les paramètres GET pour le match de la route
            $offset = strpos($this->url, "?");
            $urlToTest = empty($offset) ? $this->url : substr($this->url, 0, $offset);

            if ($route->match($urlToTest)) {
                return $route->call();
            }
        }
        throw new \Exception('No matching routes');
    }

    public function url($name, $params = [])
    {
        if (!isset($this->namedRoutes[$name])) {
            throw new \Exception('No route matches this name');
        }
        return $this->namedRoutes[$name]->getUrl($params);
    }
}
