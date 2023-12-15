<?php
namespace App\Core;

class Router {
    private $routes = [];

    public function addRoute($method, $path, $callback) {
        $this->routes[] = ['method' => $method, 'path' => $path, 'callback' => $callback];
    }

    public function match($method, $uri) {
        foreach ($this->routes as $route) {
            if ($route['method'] === $method && $route['path'] === $uri) {
                return $route['callback'];
            }
        }
        die;
        return null;
    }
}
