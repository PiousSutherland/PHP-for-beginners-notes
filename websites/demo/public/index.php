<?php

const BASE_PATH = __DIR__ . '/../';

// Critical - leave at the top
require BASE_PATH . 'Core/functions.php';
$heading = 'Something';
spl_autoload_register(function ($class) {
    require base_path(str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php');
});

require base_path('bootstrap.php');

/* Route-based exectutions */
$router = new \Core\Router();

require base_path('routes.php');

$uri =  parse_url($_SERVER['REQUEST_URI'])['path'];
$uri = $uri == '/' ? '/' : rtrim($uri, '/');

$method = $_POST['_REQUEST_METHOD'] ?? $_SERVER['REQUEST_METHOD'];

$router->route($uri, $method);
/* End Route-based executions */