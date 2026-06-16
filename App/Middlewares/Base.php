<?php

namespace App\Middlewares;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;


interface Middleware {
    public function handle($request, $next);
}




?>