<?php

  use App\Controllers\UserController;
  use App\Controllers\HomeController;

  return [
    'GET' => [
      '/' => [HomeController::class, 'index'],
      '/users' => [UserController::class, 'index'],
    ],
    'POST' => []



  ];

  ?>