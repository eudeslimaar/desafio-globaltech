<?php

require_once __DIR__ . '/vendor/autoload.php';

use core\Router;

$router = new Router();
require_once __DIR__ . '/src/routes/routes.php';

$method = $_SERVER['REQUEST_METHOD'];
$uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

$router->dispatch($method, $uri);
