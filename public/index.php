<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\Router;

try {
  $router = new Router();
  $router->dispatch(
    $_SERVER["REQUEST_METHOD"],
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
  );

} catch(\Exception $e){
  http_response_code(500);
  if ($_ENV['APP_ENV'] === 'development') {
    echo '<pre>' . $e->getMessage() . "\n" . $e->getTraceAsString() . '</pre>';
  } else {
    echo '500 - Erro interno do servidor';
  }
}

?>