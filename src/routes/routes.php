<?php
namespace routes;

use core\Router;

require_once __DIR__ . '/../../vendor/autoload.php';

$router = new Router();



$router->get('', function () {
    echo view('dashboard.index');
});

return $router;
