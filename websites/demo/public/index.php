<?php

const BASE_PATH = __DIR__ . '/../';

// Critical - leave at the top
require BASE_PATH . 'Core/functions.php';

spl_autoload_register(function ($class) {
    require base_path(str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php');
});

$router = new \Core\Router();

$routes = require base_path('routes.php');
$uri =  parse_url($_SERVER['REQUEST_URI'])['path'];
$uri = $uri == '/' ? '/' : rtrim($uri, '/');

$route->route($uri);