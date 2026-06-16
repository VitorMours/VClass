<?php 

namespace App\Middlewares;

use App\Middlewares\Base;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class LoggerMiddleware implements Middleware {
    public function handle($request, $next) {
        $logger = new Logger("vclass_logger");
        $logger->pushHandler(new StreamHandler(__DIR__ . '/../../storage/logs/app.log', Logger::INFO));
        $logger->info('Requisição recebida para: ' . $_SERVER['REQUEST_URI']);
        return $next($request);
    }
}
?>