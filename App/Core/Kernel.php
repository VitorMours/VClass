<?php 
namespace App\Core;

use App\Controllers\AuthController;
use App\Services\AuthService;
use App\Services\PasswordHasher;
use App\Services\UserService;

class Kernel {
    public function handle(string $method, string $uri) {
        $router = new Router();
        
        $route = $router->match($method, $uri);

        if (!$route) {
            http_response_code(404);
            return "404 - Página não encontrada";
        }

        $destination = function() use ($route) {
            [$controllerClass, $method] = $route['action'];
            $controller = match ($controllerClass) {
                AuthController::class => $this->createAuthController(),
                default => new $controllerClass(),
            };
            return call_user_func_array([$controller, $method], $route['params']);
        };

        // Executamos o pipeline passando os middlewares da rota
        return Pipeline::run($route['middlewares'] ?? [], $destination);
    }
    
    private function createAuthController(): AuthController
    {
        $passwordHasher = new PasswordHasher();
        $authService = new AuthService($passwordHasher);
        $userService = new UserService($authService);

        return new AuthController($authService, $userService);
    }
}
?>