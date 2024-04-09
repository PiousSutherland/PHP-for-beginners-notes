<?php

use Core\Response;

function routeToController()
{
    global $routes, $uri;

    if (array_key_exists($uri, $routes))
        require base_path($routes[$uri]);
    else
        abort();
}

function abort($code = Response::NOT_FOUND)
{
    http_response_code($code);
    $heading = $code;
    view('error.php');

    die();
}
$routes = require base_path('routes.php');
$uri =  parse_url($_SERVER['REQUEST_URI'])['path'];
$uri = $uri == '/' ? '/' : rtrim($uri, '/');

routeToController();
