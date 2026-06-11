<?php
// app/Core/Router.php

namespace App\Core;

class Router {
    private array $routes;
    public function __construct()
    {
        $this->routes = require base_path('routes/web.php');
    }

    public function dispatch(string $method, string $uri): void
    {
        $routes = $this->routes[$method] ?? [];

        foreach ($routes as $pattern => $action) {
            $regex = preg_replace('/\{[a-z]+\}/', '([^/]+)', $pattern);
            $regex = "#^{$regex}$#";

            if (preg_match($regex, $uri, $matches)) {
                array_shift($matches); // remove o match completo

                [$controllerClass, $method] = $action;
                $controller = new $controllerClass();
                call_user_func_array([$controller, $method], $matches);
                return;
            }
        }

        http_response_code(404);
        echo '404 - Página não encontrada';
    }
}