<?php

namespace Core;

use Core\Response;

class Router
{
    protected $routes = [];

    public function get($uri, $controller)
    {
        static::push($uri, $controller, 'GET');
    }

    public function post($uri, $controller)
    {
        static::push($uri, $controller, 'POST');
    }

    public function delete($uri, $controller)
    {
        static::push($uri, $controller, 'DELETE');
    }

    public function put($uri, $controller)
    {
        static::push($uri, $controller, 'PUT');
    }

    public function patch($uri, $controller)
    {
        static::push($uri, $controller, 'PATCH');
    }
    public function push($uri, $controller, $method)
    {
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'method' => strtoupper($method)
        ];
    }

    public function route($uri)
    {
        foreach ($this->routes as $route) {
            if ($route['uri'] == $uri) {
                return require base_path('controllers/' . $route['controller']);
            }
        }

        static::abort();
    }

    function abort($code = Response::NOT_FOUND)
    {
        http_response_code($code);
        $heading = $code;
        view('error.php');

        die();
    }
    //     function routeToController()
    // {
    //     global $routes, $uri;

    //     if (array_key_exists($uri, $routes))
    //         require base_path($routes[$uri]);
    //     else
    //         abort();
    // }

    // function abort($code = Response::NOT_FOUND)
    // {
    //     http_response_code($code);
    //     $heading = $code;
    //     view('error.php');

    //     die();
    // }
    // $routes = require base_path('routes.php');
    // $uri =  parse_url($_SERVER['REQUEST_URI'])['path'];
    // $uri = $uri == '/' ? '/' : rtrim($uri, '/');

    // routeToController();
}
