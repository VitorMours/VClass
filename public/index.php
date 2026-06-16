<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\Kernel;

session_start();

try {
    $kernel = new Kernel();

    $response = $kernel->handle(
        $_SERVER["REQUEST_METHOD"], 
        parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
    );

    echo $response;

} catch (\Exception $e) {
    http_response_code(500);
    if (isset($_ENV['APP_ENV']) && $_ENV['APP_ENV'] === 'development') {
        echo '<pre>' . $e->getMessage() . "\n" . $e->getTraceAsString() . '</pre>';
    } else {
        echo '500 - Erro interno do servidor';
    }
}