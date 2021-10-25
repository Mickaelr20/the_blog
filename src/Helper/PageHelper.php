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
        $requested_page = $this->request->getServer()["REQUEST_URI"];
        return str_contains($requested_page, $link);
    }
}
