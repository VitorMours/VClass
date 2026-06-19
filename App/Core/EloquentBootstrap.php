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
      // Configuração padrão para produção/desenvolvimento
      $config = parse_ini_file("config.ini", true);
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
