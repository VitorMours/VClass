<?php
namespace App\Core;

class Router {
    private array $routes;

    public function __construct() {
        $this->routes = require base_path('routes/web.php');
    }

    public function match(string $method, string $uri): ?array {
        foreach ($this->routes[$method] ?? [] as $pattern => $config) {
            $regex = "#^" . preg_replace('/\{[a-z]+\}/', '([^/]+)', $pattern) . "$#";
            if (preg_match($regex, $uri, $matches)) {
                array_shift($matches);
                return [
                    'action' => $config['action'],
                    'middlewares' => $config['middlewares'] ?? [],
                    'params' => $matches
                ];
            }
        }
        return null;
    }
}