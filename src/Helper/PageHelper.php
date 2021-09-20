<?php

namespace App\Helper;

class PageHelper
{

    public function __construct()
    {
    }

    public function is_menu_link_active($link): bool
    {
        $temp_page = explode('/', $_SERVER['REQUEST_URI']);
        $page = $temp_page[count($temp_page) - 1];
        $res = false;

        if ($page != null && $link === $page) {
            $res = true;
        }

        return $res;
    }
}
