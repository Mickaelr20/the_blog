<?php

namespace App\Helper;

class Renderer
{
    var $modele;
    var $namespace;
    var $layout = "default";

    public function __construct($modele, $namespace = "")
    {
        $this->modele = $modele;
        $this->namespace = $namespace;
    }

    public function setNamespace($namespace)
    {
        $this->namespace = $namespace;
        return $this;
    }

    public function setLayout($layout)
    {
        $this->layout = $layout;
        return $this;
    }

    public function template($modele, $elem, $templateVars = [])
    {
        extract($templateVars);
        include "src/Template/" . $modele . (empty($this->namespace) ? "/" : "/" . $this->namespace . "/") . $elem . ".php";
    }

    public function element($url, $vars = [])
    {
        extract($vars);
        include "src/Template/Element" . (empty($this->namespace) ? "/" : "/" . $this->namespace . "/") . $url;
    }

    public function renderLayout($layout, $vars = [])
    {

        extract($vars);

        include "src/Template/Layout"  . (empty($this->namespace) ? "/" : "/" . $this->namespace . "/") . $layout;
    }

    public function render($elem, $vars = [])
    {
        $templateVars = array_merge($vars, [
            "renderer" => $this,
            "user" => empty($_SESSION["user"]) ? [] : $_SESSION['user']
        ]);

        ob_start();

        $this->template($this->modele, $elem, $templateVars);

        $content = ob_get_clean();

        $layoutVars = array_merge($vars, $templateVars, [
            "content" => $content
        ]);

        $this->renderLayout($this->layout . ".php", $layoutVars);
    }
}
