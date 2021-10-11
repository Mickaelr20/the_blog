<?php

session_start();

require "vendor/autoload.php";

use App\Helper\{SessionHelper, Resolver, RequestHelper};
use App\Router;

$request = new RequestHelper();

$request_url = $request->getServer()["REQUEST_URI"];
$router = new Router($request_url);
$router->get('/', function () {
    $resolver = new Resolver("PagesController", "display");
    $resolver->resolve(['page' => 'index']);
});

$router->both('/users/login/', function () {
    $resolver = new Resolver("UsersController", "login");
    $resolver->resolve([]);
});

$router->get('/users/login_success/', function () {
    $resolver = new Resolver("UsersController", "login_success");
    $resolver->resolve([]);
});

$router->both('/users/signup/', function () {
    $resolver = new Resolver("UsersController", "signup");
    $resolver->resolve([]);
});

$router->get('/users/signup_success/', function () {
    $resolver = new Resolver("UsersController", "signup_success");
    $resolver->resolve([]);
});

$router->get('/users/logout/', function () {
    $resolver = new Resolver("UsersController", "logout");
    $resolver->resolve([]);
});

$router->get('/publications/', function () {
    $resolver = new Resolver("PostsController", "index");
    $resolver->resolve(["page" => 0]);
});

$router->get('/publications/:page', function ($page) {
    $resolver = new Resolver("PostsController", "index");
    $resolver->resolve(["page" => $page]);
});

$router->get('/publication/:id', function ($id) {
    $resolver = new Resolver("PostsController", "view");
    $resolver->resolve(["id" => $id]);
});

if (str_starts_with($request_url, "/admin")) {
    $session = new SessionHelper();
    $error = "";
    $user = $session->get("user");

    if (!empty($user)) {
        if (!$user['is_validated']) {
            $error = "vous devez être validé pour accéder a cette partie du site.";
        }
    } else {
        $error = "vous devez être connecté pour accéder a cette partie du site.";
    }

    $router->get('/admin/', function () use ($error) {
        if (empty($error)) {
            $resolver = new Resolver("Admin\PagesController", "display");
            $resolver->resolve(["page" => "index"]);
        } else {
            $resolver = new Resolver("ErrorsController", "error");
            $resolver->resolve(["code" => "401", 'message' => $error]);
        }
    });

    $router->both('/admin/posts/', function () use ($error) {
        if (empty($error)) {
            $resolver = new Resolver("Admin\PostsController", "index");
            $resolver->resolve(["page" => 0]);
        } else {
            $resolver = new Resolver("ErrorsController", "error");
            $resolver->resolve(["code" => "401", 'message' => $error]);
        }
    });

    $router->both('/admin/posts/new/', function () use ($error) {
        if (empty($error)) {
            $resolver = new Resolver("Admin\PostsController", "new");
            $resolver->resolve([]);
        } else {
            $resolver = new Resolver("ErrorsController", "error");
            $resolver->resolve(["code" => "401", 'message' => $error]);
        }
    });

    $router->both('/admin/posts/edit/:post_id', function ($post_id) use ($error) {
        if (empty($error)) {
            $resolver = new Resolver("Admin\PostsController", "edit");
            $resolver->resolve(["post_id" => $post_id]);
        } else {
            $resolver = new Resolver("ErrorsController", "error");
            $resolver->resolve(["code" => "401", 'message' => $error]);
        }
    });

    $router->post('/admin/posts/update/', function () use ($error) {
        if (empty($error)) {
            $resolver = new Resolver("Admin\PostsController", "update");
            $resolver->resolve([]);
        } else {
            $resolver = new Resolver("ErrorsController", "error");
            $resolver->resolve(["code" => "401", 'message' => $error]);
        }
    });

    $router->get('/admin/posts/deleted_post/:post_id', function ($post_id) use ($error) {
        if (empty($error)) {
            $resolver = new Resolver("Admin\PostsController", "deleted_post");
            $resolver->resolve(["post_id" => $post_id]);
        } else {
            $resolver = new Resolver("ErrorsController", "error");
            $resolver->resolve(["code" => "401", 'message' => $error]);
        }
    });

    $router->both('/admin/posts/delete/:post_id', function ($post_id) use ($error) {
        if (empty($error)) {
            $resolver = new Resolver("Admin\PostsController", "delete");
            $resolver->resolve(["post_id" => $post_id]);
        } else {
            $resolver = new Resolver("ErrorsController", "error");
            $resolver->resolve(["code" => "401", 'message' => $error]);
        }
    });

    $router->get('/admin/posts/:page', function ($page) use ($error) {
        if (empty($error)) {
            $resolver = new Resolver("Admin\PostsController", "index");
            $resolver->resolve(["page" => $page]);
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
