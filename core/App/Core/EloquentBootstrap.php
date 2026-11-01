<?php

namespace App\Core;

use Illuminate\Database\Capsule\Manager as Capsule;

class EloquentBootstrap
{
  public static function init(bool $inMemory = false)
  {
    $capsule = new Capsule;

    if ($inMemory) {
      // Configuração para rodar testes isolados em memória
      $capsule->addConnection([
        'driver'   => 'sqlite',
        'database' => ':memory:',
        'prefix'   => '',
      ]);
    } else {
      $configPath = dirname(__DIR__, 2) . '/config.ini';
      $config = parse_ini_file($configPath, true);

      $dbPath = $config["database"]["database_path"];

      $capsule->addConnection([
        'driver'   => 'sqlite',
        'database' => $dbPath,
        'prefix'   => '',
      ]);
    }

    $capsule->setAsGlobal();
    $capsule->bootEloquent();
  }
}
