<?php

namespace Core;

use Core\Response;

class Router
{
    protected $routes = [];

    public function get($uri, $controller)
    {
        $this->_push($uri, $controller, 'GET');
    }

    public function post($uri, $controller)
    {
        $this->_push($uri, $controller, 'POST');
    }

    public function delete($uri, $controller)
    {
        $this->_push($uri, $controller, 'DELETE');
    }

    public function put($uri, $controller)
    {
        $this->_push($uri, $controller, 'PUT');
    }

    public function patch($uri, $controller)
    {
        $this->_push($uri, $controller, 'PATCH');
    }
    private function _push($uri, $controller, $method)
    {
        $this->routes[] = compact('uri', 'controller', 'method');
    }

    public function route($uri, $method)
    {
        foreach ($this->routes as $route) {
            if ($route['uri'] == $uri && $route['method'] == strtoupper($method)) {
                return require base_path($route['controller']);
            }
        }

        abort();
    }
}
