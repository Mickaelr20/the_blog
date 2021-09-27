<?php

session_start();

require "vendor/autoload.php";

use App\Helper\SessionHelper;
use App\Router;
use App\Helper\Resolver;

$request_url = empty($_SERVER['REQUEST_URI']) ? "/" : $_SERVER['REQUEST_URI'];
$router = new Router($request_url);
$router->get('/', function () {
    $resolver = new Resolver("PagesController", "display");
    $resolver->resolve(['page' => 'index']);
});

$router->both('/users/login', function () {
    $resolver = new Resolver("UsersController", "login");
    $resolver->resolve([]);
});

$router->get('/users/login_success', function () {
    $resolver = new Resolver("UsersController", "login_success");
    $resolver->resolve([]);
});

$router->both('/users/signup', function () {
    $resolver = new Resolver("UsersController", "signup");
    $resolver->resolve([]);
});

$router->get('/users/signup_success', function () {
    $resolver = new Resolver("UsersController", "signup_success");
    $resolver->resolve([]);
});

$router->get('/users/logout', function () {
    $resolver = new Resolver("UsersController", "logout");
    $resolver->resolve([]);
});

$router->get('/publications', function () {
    $resolver = new Resolver("PostsController", "index");
    $resolver->resolve([]);
});

$router->get('/publications/:page', function ($page) {
    $resolver = new Resolver("PostsController", "index");
    $resolver->resolve($page);
});

if (str_starts_with($request_url, "/admin")) {
    $error = "";
    $user = SessionHelper::get("user");

    if (!empty($user)) {
        if (!$user['is_validated']) {
            $error = "vous devez être validé pour accéder a cette partie du site.";
        }
    } else {
        $error = "vous devez être connecté pour accéder a cette partie du site.";
    }

    $router->get('/admin', function () use ($error) {
        if (empty($error)) {
            $resolver = new Resolver("Admin\PagesController", "display");
            $resolver->resolve(["page" => "index"]);
        } else {
            $resolver = new Resolver("ErrorsController", "error");
            $resolver->resolve(["code" => "401", 'message' => $error]);
        }
    });

    $router->get('/admin/posts', function () use ($error) {
        if (empty($error)) {
            $resolver = new Resolver("Admin\PostsController", "index");
            $resolver->resolve([]);
        } else {
            $resolver = new Resolver("ErrorsController", "error");
            $resolver->resolve(["code" => "401", 'message' => $error]);
        }
    });

    $router->get('/admin/posts/new', function () use ($error) {
        if (empty($error)) {
            $resolver = new Resolver("Admin\PostsController", "new");
            $resolver->resolve([]);
        } else {
            $resolver = new Resolver("ErrorsController", "error");
            $resolver->resolve(["code" => "401", 'message' => $error]);
        }
    });
}

try {
    $router->run();
} catch (\Exception $e) {
    var_dump($e);
    // $resolver = new Resolver("ErrorsController", "error");
    // $resolver->resolve(['code' => '404']);
}
