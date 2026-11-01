<?php 

namespace App\Middlewares; 

class AuthMiddleware implements Middleware {

    public function handle($request, $next) {
        if (empty($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }

        return $next($request);
    }
}



?>