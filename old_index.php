<?php

$prefix = "public";
$controller = "pages";
$action = "index";
$parameters = [];

if (!empty($_GET['url'])) {
    $url = $_GET['url'];
    $url_parts = explode("/", $url);

    if (empty($url_parts[count($url_parts) - 1])) {
        unset($url_parts[count($url_parts) - 1]);
    }

    $url_parts_length = count($url_parts);

    switch ($url_parts_length) {
        case 0:
            break;
        case 1:
            $controller = $url_parts[0];
            break;
        case 2:
            $action = $url_parts[count($url_parts) - 1];
            $url = implode("/", $url_parts);
            break;
    }

    if ($url_parts_length > 1) {
    }


    if (count($_GET) > 1) { //Params exists (?p=v&p2=v2...)

    }
}

//redirect to default page
