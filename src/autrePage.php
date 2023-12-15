<?php

use App\Core\Router;
use App\Controllers\TestController;

error_reporting(E_ALL);
ini_set('display_errors', 1);
$dir = '../vendor/autoload.php';
require_once($dir);

$router = new Router();

// Route vers la méthode index() du UserController
$router->addRoute('GET', '/src/autrePage.php', [new TestController(), 'index']);


// Obtenez le chemin de l'URL actuelle
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
// Obtenez la méthode de la requête HTTP
$method = $_SERVER['REQUEST_METHOD'];

// Recherchez une correspondance dans les routes
$route = $router->match($method, $uri);

// Exécutez la callback si une correspondance est trouvée
if ($route) {
    call_user_func($route);
} else {
    // Gérez les routes non trouvées ici
    echo '404 Not Found';
}
