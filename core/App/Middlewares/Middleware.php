<?php
declare(strict_types=1);

namespace App\Middlewares;

interface Middleware
{
    public function handle($request, $next);
}
