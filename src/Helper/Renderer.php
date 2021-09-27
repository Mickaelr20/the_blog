<?php

namespace App\Helper;

use App\Helper\SessionHelper;

class Renderer
{

    const DEFAULT_VARS = [];
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
        include sprintf(
            'src/Template%s/%s/%s.php',
            empty($this->namespace) ? "" : "/" . $this->namespace,
            $modele,
            $elem
        );
    }

    public function element($url, $vars = [])
    {
        $vars_to_extract = array_merge($vars, [
            "renderer" => $this,
            "pageHelper" => new \App\Helper\PageHelper(),
            "user" => SessionHelper::get("user")
        ]);

        extract($vars_to_extract);
        include sprintf(
            'src/Template%s/Element/%s.php',
            empty($this->namespace) ? "" : "/" . $this->namespace,
            $url
        );
    }

    public function renderLayout($layout, $vars = [])
    {

        extract($vars);

        include sprintf(
            'src/Template%s/Layout/%s.php',
            empty($this->namespace) ? "" : "/" . $this->namespace,
            $layout
        );
    }

    public function render($elem, $vars = [])
    {
        $templateVars = array_merge($vars, [
            "renderer" => $this,
            "pageHelper" => new \App\Helper\PageHelper(),
            "user" => SessionHelper::get("user")
        ]);

        ob_start();

        $this->template($this->modele, $elem, $templateVars);

        $content = ob_get_clean();

        $layoutVars = array_merge($vars, $templateVars, [
            "content" => $content
        ]);

        $this->renderLayout($this->layout, $layoutVars);
    }
}
