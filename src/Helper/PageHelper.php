<?php

namespace App\Helper;

use App\Helper\RequestHelper;

class PageHelper
{

    var $request;
    var $scripts = [];
    var $styles = [];

    public function __construct()
    {
        $this->request = new RequestHelper();
    }

    public function is_menu_link_active($link): bool
    {
        $requested_page = $this->request->getServer()["REQUEST_URI"];
        return str_contains($requested_page, $link);
    }

    public function addScript($link, $bloc = 'default')
    {
        $this->scripts[$bloc][] = $link;
    }

    public function printScripts($bloc = "default")
    {
        $res = "";
        if (!empty($this->scripts[$bloc])) {
            foreach ($this->scripts[$bloc] as $script_link) {
                $res .= '<script type="text/javascript" src="/js/' . $script_link . '"></script>';
            }
        }
        return $res;
    }

    public function addStyle($link, $bloc = 'default')
    {
        $this->styles[$bloc][] = $link;
    }

    public function printStyles($bloc = "default")
    {
        $res = "";
        if (!empty($this->styles[$bloc])) {
            foreach ($this->styles[$bloc] as $style_link) {
                $res .= '<link rel="stylesheet" href="/css/' . $style_link . '">';
            }
        }
        return $res;
    }
}
