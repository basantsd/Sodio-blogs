<?php

// app/routes.php

use App\Core\Middleware;
use App\Core\Router;

function registerRoutes(Router $router) {
    $middleware = new Middleware();
    $router->add('/', 'HomeController@index');

    $router->add('/login', 'AuthController@login');
    $router->add('/register', 'AuthController@register');

    $router->add('/logout', 'AuthController@logout',[$middleware, 'isUserAuthenticated']);


    $router->add('/post/{slug}', 'PostController@details',[$middleware, 'isUserAuthenticated']);
    $router->add('/add-comment', 'PostController@add_comment',[$middleware, 'isUserAuthenticated']);


    $router->add('/admin', 'admin\DashboardController@index',[$middleware, 'isAdminAuthenticated']);
    $router->add('/admin/login', 'admin\AdminAuthController@login');
    $router->add('/admin/forgot-password', 'admin\AdminAuthController@forgot_password');
    $router->add('/admin/reset-password', 'admin\AdminAuthController@reset_password');

    $router->add('/admin/logout', 'admin\AdminAuthController@logout',[$middleware, 'isAdminAuthenticated']);

    $router->add('/admin/dashboard', 'admin\DashboardController@index', [$middleware, 'isAdminAuthenticated']);


    $router->add('/admin/comments', 'admin\PostController@comments', [$middleware, 'isAdminAuthenticated']);
    $router->add('/admin/comment/status', 'admin\PostController@comment_status', [$middleware, 'isAdminAuthenticated']);

    $router->add('/admin/posts', 'admin\PostController@index', [$middleware, 'isAdminAuthenticated']);
    $router->add('/admin/posts/create', 'admin\PostController@create', [$middleware, 'isAdminAuthenticated']);
    $router->add('/admin/posts/edit/{id}', 'admin\PostController@edit', [$middleware, 'isAdminAuthenticated']);
    $router->add('/admin/posts/delete/{id}', 'admin\PostController@delete', [$middleware, 'isAdminAuthenticated']);

    $router->add('/admin/category', 'admin\CategoryController@index', [$middleware, 'isAdminAuthenticated']);
    $router->add('/admin/category/create', 'admin\CategoryController@create', [$middleware, 'isAdminAuthenticated']);
    $router->add('/admin/category/edit/{id}', 'admin\CategoryController@edit', [$middleware, 'isAdminAuthenticated']);
    $router->add('/admin/category/delete/{id}', 'admin\CategoryController@delete', [$middleware, 'isAdminAuthenticated']);

    $router->add('/admin/users', 'admin\UserController@index', [$middleware, 'isAdminAuthenticated']);
    $router->add('/admin/users/create', 'admin\UserController@create', [$middleware, 'isAdminAuthenticated']);
    $router->add('/admin/users/edit/{id}', 'admin\UserController@edit', [$middleware, 'isAdminAuthenticated']);
    $router->add('/admin/users/delete/{id}', 'admin\UserController@delete', [$middleware, 'isAdminAuthenticated']);
}


?>