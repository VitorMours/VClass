<?php

namespace App\Core;

class Pipeline {
    /**
     * @param array $pipes Lista de classes de Middleware
     * @param callable $destination O Controller final
     */
    public static function run(array $pipes, callable $destination) {
        // Invertemos a lista para que o primeiro da lista seja o primeiro a rodar
        $pipeline = array_reduce(
            array_reverse($pipes),
            function ($next, $pipe) {
                return function ($request) use ($next, $pipe) {
                    // Instancia o middleware e chama seu método handle
                    return (new $pipe())->handle($request, $next);
                };
            },
            $destination
        );
        return $pipeline([]);
    }
}
