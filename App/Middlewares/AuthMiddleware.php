<?php 

namespace App\Middlewares; 

class AuthMiddleware implements Middleware {

    public function handle($request, $next) {
        $next($request);
    }
}



?>