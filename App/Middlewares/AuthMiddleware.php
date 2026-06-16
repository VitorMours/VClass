<?php 

namespace App\Middlewares; 


use App\Middlewares\Base; 


class AuthMiddleware implements Middleware {

    public function handle($request, $next) {



        $next($request);
    }
}



?>