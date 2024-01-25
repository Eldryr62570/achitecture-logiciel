<?php
namespace App\Core;

class Router {
    private $routes = [];

    public function addRoute($method, $path, $callback) {
        $this->routes[] = ['method' => $method, 'path' => $path, 'callback' => $callback];
    }

    public function match($method, $uri) {
        foreach ($this->routes as $route) {
            // Vérifiez d'abord la méthode et le chemin
            if ($route['method'] === $method && $route['path'] === $uri) {
                if ($method === 'POST' && isset($_POST['action'])) {
                    $controller = $route['callback'][0];
                    $action = $_POST['action'];
                    if (method_exists($controller, $action)) {
                        return [$controller, $action];
                    }
                } else {
                    // Pour les autres requêtes, retournez simplement le callback complet
                    return $route['callback'];
                }
            }
        }
        return null; // Aucune route correspondante trouvée
    }
}
