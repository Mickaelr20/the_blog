<?php

namespace App\Helper;

use App\Helper\RequestHelper;

class PageHelper
{

    var $request;
    public function __construct()
    {
        $this->request = new RequestHelper();
    }

    public function is_menu_link_active($link): bool
    {
        $temp_page = explode('/', $this->request->getServer()["REQUEST_URI"]);
        $page = $temp_page[count($temp_page) - 1];
        $res = false;

        if ($page != null && $link === $page) {
            $res = true;
        }

        return $res;
    }
}
