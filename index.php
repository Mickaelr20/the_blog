<?php

session_start();
session_regenerate_id();

require "vendor/autoload.php";

use App\Helper\{SessionHelper, Resolver, RequestHelper};
use App\Router;

$request = new RequestHelper();
$sessionHelper = new SessionHelper();

if ($request->getType() === "GET") {
    $sessionHelper->generateNewToken();
}

$request_url = $request->getServer()["REQUEST_URI"];
$router = new Router($request_url);
$router->get('/', function () {
    $resolver = new Resolver("PagesController", "display");
    $resolver->resolve(['page' => 'index', 'title' => 'Accueil', 'layout' => "accueil"]);
});

$router->get('/login', function () {
    $resolver = new Resolver("UsersController", "login");
    $resolver->resolve(['title' => 'Connexion']);
});

$router->get('/logout', function () {
    $resolver = new Resolver("UsersController", "logout");
    $resolver->resolve(['title' => 'Déconnxion']);
});

$router->get('/confidentialite', function () {
    $resolver = new Resolver("PagesController", "display");
    $resolver->resolve(['page' => 'confidentialite', 'title' => 'Confidentialité', 'layout' => "default"]);
});

$router->get('/conditions_utilisation', function () {
    $resolver = new Resolver("PagesController", "display");
    $resolver->resolve(['page' => 'conditions_utilisation', 'title' => 'Conditions d\'utilisation', 'layout' => "default"]);
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

$router->get('/publication/:id/', function ($id) {
    $resolver = new Resolver("PostsController", "view");
    $resolver->resolve(["id" => $id, "comment_page" => 0]);
});

$router->get('/publication/:id/:comment_page', function ($id, $comment_page) {
    $resolver = new Resolver("PostsController", "view");
    $resolver->resolve(["id" => $id, "comment_page" => $comment_page]);
});

$router->post('/comments/new', function () {
    $resolver = new Resolver("CommentsController", "new");
    $resolver->resolve([]);
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
            $resolver = new Resolver("Admin\UsersController", "index");
            $resolver->resolve(["page" => 0]);
        } else {
            $resolver = new Resolver("ErrorsController", "error");
            $resolver->resolve(["code" => "401", 'message' => $error]);
        }
    });

    /* POSTS */
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

    $router->get('/admin/posts/:page', function ($page) use ($error) {
        if (empty($error)) {
            $resolver = new Resolver("Admin\PostsController", "index");
            $resolver->resolve(["page" => $page]);
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

    $router->both('/admin/posts/delete/:post_id', function ($post_id) use ($error) {
        if (empty($error)) {
            $resolver = new Resolver("Admin\PostsController", "delete");
            $resolver->resolve(["post_id" => $post_id]);
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

    $router->post('/admin/posts/edit_image/', function () use ($error) {
        if (empty($error)) {
            $resolver = new Resolver("Admin\PostsController", "edit_image");
            $resolver->resolve([]);
        } else {
            $resolver = new Resolver("ErrorsController", "error");
            $resolver->resolve(["code" => "401", 'message' => $error]);
        }
    });

    $router->get('/admin/posts/edit_image/', function ($post_id) use ($error) {
        if (empty($error)) {
            $resolver = new Resolver("Admin\PostsController", "edit");
            $resolver->resolve([]);
        } else {
            $resolver = new Resolver("ErrorsController", "error");
            $resolver->resolve(["code" => "401", 'message' => $error]);
        }
    });


    /* COMMENTS */
    $router->get('/admin/comments/', function () use ($error) {
        if (empty($error)) {
            $resolver = new Resolver("Admin\CommentsController", "index");
            $resolver->resolve(["page" => 0]);
        } else {
            $resolver = new Resolver("ErrorsController", "error");
            $resolver->resolve(["code" => "401", 'message' => $error]);
        }
    });

    $router->both('/admin/comments/new/', function () use ($error) {
        if (empty($error)) {
            $resolver = new Resolver("Admin\CommentsController", "new");
            $resolver->resolve([]);
        } else {
            $resolver = new Resolver("ErrorsController", "error");
            $resolver->resolve(["code" => "401", 'message' => $error]);
        }
    });

    $router->get('/admin/comments/:page', function ($page) use ($error) {
        if (empty($error)) {
            $resolver = new Resolver("Admin\CommentsController", "index");
            $resolver->resolve(["page" => $page]);
        } else {
            $resolver = new Resolver("ErrorsController", "error");
            $resolver->resolve(["code" => "401", 'message' => $error]);
        }
    });

    $router->both('/admin/comments/edit/:comment_id', function ($comment_id) use ($error) {
        if (empty($error)) {
            $resolver = new Resolver("Admin\CommentsController", "edit");
            $resolver->resolve(["comment_id" => $comment_id]);
        } else {
            $resolver = new Resolver("ErrorsController", "error");
            $resolver->resolve(["code" => "401", 'message' => $error]);
        }
    });

    $router->post('/admin/comments/update/', function () use ($error) {
        if (empty($error)) {
            $resolver = new Resolver("Admin\CommentsController", "update");
            $resolver->resolve([]);
        } else {
            $resolver = new Resolver("ErrorsController", "error");
            $resolver->resolve(["code" => "401", 'message' => $error]);
        }
    });

    $router->both('/admin/comments/delete/:comment_id', function ($comment_id) use ($error) {
        if (empty($error)) {
            $resolver = new Resolver("Admin\CommentsController", "delete");
            $resolver->resolve(["comment_id" => $comment_id]);
        } else {
            $resolver = new Resolver("ErrorsController", "error");
            $resolver->resolve(["code" => "401", 'message' => $error]);
        }
    });

    $router->get('/admin/comments/deleted_comment/:comment_id', function ($comment_id) use ($error) {
        if (empty($error)) {
            $resolver = new Resolver("Admin\CommentsController", "deleted_comment");
            $resolver->resolve(["comment_id" => $comment_id]);
        } else {
            $resolver = new Resolver("ErrorsController", "error");
            $resolver->resolve(["code" => "401", 'message' => $error]);
        }
    });

    /* USERS */
    $router->both('/admin/users/', function () use ($error) {
        if (empty($error)) {
            $resolver = new Resolver("Admin\UsersController", "index");
            $resolver->resolve(["page" => 0]);
        } else {
            $resolver = new Resolver("ErrorsController", "error");
            $resolver->resolve(["code" => "401", 'message' => $error]);
        }
    });

    $router->both('/admin/users/new/', function () use ($error) {
        if (empty($error)) {
            $resolver = new Resolver("Admin\UsersController", "new");
            $resolver->resolve([]);
        } else {
            $resolver = new Resolver("ErrorsController", "error");
            $resolver->resolve(["code" => "401", 'message' => $error]);
        }
    });

    $router->get('/admin/users/:page', function ($page) use ($error) {
        if (empty($error)) {
            $resolver = new Resolver("Admin\UsersController", "index");
            $resolver->resolve(["page" => $page]);
        } else {
            $resolver = new Resolver("ErrorsController", "error");
            $resolver->resolve(["code" => "401", 'message' => $error]);
        }
    });

    $router->both('/admin/users/edit/:user_id', function ($user_id) use ($error) {
        if (empty($error)) {
            $resolver = new Resolver("Admin\UsersController", "edit");
            $resolver->resolve(["user_id" => $user_id]);
        } else {
            $resolver = new Resolver("ErrorsController", "error");
            $resolver->resolve(["code" => "401", 'message' => $error]);
        }
    });

    $router->post('/admin/users/update/', function () use ($error) {
        if (empty($error)) {
            $resolver = new Resolver("Admin\UsersController", "update");
            $resolver->resolve([]);
        } else {
            $resolver = new Resolver("ErrorsController", "error");
            $resolver->resolve(["code" => "401", 'message' => $error]);
        }
    });
    $router->both('/admin/users/delete/:user_id', function ($user_id) use ($error) {
        if (empty($error)) {
            $resolver = new Resolver("Admin\UsersController", "delete");
            $resolver->resolve(["user_id" => $user_id]);
        } else {
            $resolver = new Resolver("ErrorsController", "error");
            $resolver->resolve(["code" => "401", 'message' => $error]);
        }
    });

    $router->get('/admin/users/deleted_user/:user_id', function ($user_id) use ($error) {
        if (empty($error)) {
            $resolver = new Resolver("Admin\UsersController", "deleted_user");
            $resolver->resolve(["user_id" => $user_id]);
        } else {
            $resolver = new Resolver("ErrorsController", "error");
            $resolver->resolve(["code" => "401", 'message' => $error]);
        }
    });
}

try {
    $router->run();
} catch (\Exception $e) {
    echo "Erreure de redirection";
    var_dump($e);
    // $resolver = new Resolver("ErrorsController", "error");
    // $resolver->resolve(['code' => '404', 'message' => 'Cette page n\'existe pas.']);
}
