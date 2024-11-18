<?php

namespace core;

require_once __DIR__ . '/../../vendor/autoload.php';

class Router {
    private array $routes = [];

    public function get($route, $action): void
    {
        $this->addRoute('GET', $route, $action);
    }

    public function post($route, $action): void
    {
        $this->addRoute('POST', $route, $action);
    }

    public function put($route, $action): void
    {
        $this->addRoute('PUT', $route, $action);
    }

    public function delete($route, $action): void
    {
        $this->addRoute('DELETE', $route, $action);
    }

    private function addRoute($method, $route, $action): void
    {
        $this->routes[] = compact('method', 'route', 'action');
    }

    public function dispatch($method, $uri) {
        foreach ($this->routes as $route) {
            if ($route['method'] === $method && preg_match($this->convertToRegex($route['route']), $uri, $matches)) {
                array_shift($matches);
                return is_callable($route['action']) ?
                    call_user_func_array($route['action'], $matches) :
                    $this->callController($route['action'], $matches);
            }
        }

        // Página 404
        http_response_code(404);
        echo view('404');
    }

    private function convertToRegex($route): string
    {
        $route = preg_quote($route, '/');
        $route = preg_replace('/\\\{[a-zA-Z]+\\\}/', '([a-zA-Z0-9_-]+)', $route);
        return '/^' . $route . '$/';
    }

    private function callController($action, $params): void
    {
        list($controller, $method) = $action;
        if (class_exists($controller) && method_exists($controller, $method)) {
            $controllerInstance = new $controller();
            call_user_func_array([$controllerInstance, $method], $params);
        } else {
            http_response_code(500);
        }
    }
}
