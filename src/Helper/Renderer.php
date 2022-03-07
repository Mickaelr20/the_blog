<?php

namespace App\Helper;

use App\Helper\{PageHelper, SessionHelper};

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
        include sprintf(
            'src/Template%s/%s/%s.php',
            empty($this->namespace) ? "" : "/" . $this->namespace,
            $modele,
            $elem
        );
    }

    public function element($url, $vars = [])
    {
        $session = new SessionHelper();
        $vars_to_extract = array_merge($vars, [
            "renderer" => $this,
            "pageHelper" => new PageHelper(),
            "sessionHelper" => new SessionHelper(),
            "user" => $session->get("user")
        ]);

        extract($vars_to_extract);

        $path_to_test = [sprintf(
            'src/Template%s/Element/%s.php',
            empty($this->namespace) ? "" : "/" . $this->namespace,
            $url
        ), sprintf(
            'src/Template/Element/%s.php',
            $url
        )];
        $found = false;

        do {
            $path = array_shift($path_to_test);
            if (file_exists($path)) {
                $found = true;
            }
        } while (!empty($path) && !$found);


        if (empty($path)) {
            include sprintf(
                'src/Template%s/Element/element_not_found.php',
                empty($this->namespace) ? "" : "/" . $this->namespace
            );
            return;
        }

        include $path;
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
        $session = new SessionHelper();
        $templateVars = array_merge($vars, [
            "renderer" => $this,
            "pageHelper" => new PageHelper(),
            "requestData" => (new RequestHelper())->getRequestData(),
            "sessionHelper" => new SessionHelper(),
            "user" => $session->get("user")
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
