<?php

$routes = require 'routes.php';

$uri =  parse_url($_SERVER['REQUEST_URI'])['path'];
$uri = $uri == '/' ? '/' : rtrim($uri, '/');

function abort($code = Response::NOT_FOUND)
{
    http_response_code($code);
    $heading = $code;
    require 'views/error.php';
    die();
}

function routeToController()
{
    global $routes, $uri;

    if (array_key_exists($uri, $routes))
        require $routes[$uri];
    else {
        abort();
    }
}

routeToController();
