<?php 
namespace App\Core;

class Kernel {
    public function handle(string $method, string $uri) {
        $router = new Router();
        
        // O router precisa ser ajustado para retornar não apenas a action, 
        // mas também os middlewares associados àquela rota.
        $route = $router->match($method, $uri);

        if (!$route) {
            http_response_code(404);
            return "404 - Página não encontrada";
        }

        // Definimos o que acontece no "centro da cebola": a execução do controller
        $destination = function() use ($route) {
            [$controllerClass, $method] = $route['action'];
            $controller = new $controllerClass();
            return call_user_func_array([$controller, $method], $route['params']);
        };

        // Executamos o pipeline passando os middlewares da rota
        return Pipeline::run($route['middlewares'] ?? [], $destination);
    }
}
?>