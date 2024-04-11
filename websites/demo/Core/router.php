<?php

namespace Core;

use Core\Middleware\Auth;
use Core\Middleware\Guest;
use Core\Middleware\Middleware;

class Router
{
    protected $routes = [];

    public function get($uri, $controller)
    {
        return $this->_push($uri, $controller, 'GET');
    }

    public function post($uri, $controller)
    {
        return $this->_push($uri, $controller, 'POST');
    }

    public function delete($uri, $controller)
    {
        return $this->_push($uri, $controller, 'DELETE');
    }

    public function put($uri, $controller)
    {
        return $this->_push($uri, $controller, 'PUT');
    }

    public function patch($uri, $controller)
    {
        return $this->_push($uri, $controller, 'PATCH');
    }
    private function _push($uri, $controller, $method)
    {
        $middleware = null;
        $this->routes[] = compact('uri', 'controller', 'method', 'middleware');

        return $this;
    }

    public function route($uri, $method)
    {
        foreach ($this->routes as $route) {
            if ($route['uri'] == $uri && $route['method'] == strtoupper($method)) {
                Middleware::resolve($route['middleware']);

                return require base_path($route['controller']);
            }
        }

        abort();
    }

    public function only($key)
    {
        $this->routes[array_key_last($this->routes)]['middleware'] = $key;

        return $this;
    }
}
