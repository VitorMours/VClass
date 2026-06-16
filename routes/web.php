<?php

  use App\Controllers\UserController;
  use App\Controllers\HomeController;
  use App\Controllers\AuthController;

  return [
    'GET' => [
      '/' => [HomeController::class, 'index'],
      '/login' => [AuthController::class, 'login'],
      '/signin' => [AuthController::class, 'signin'],
      '/users' => [UserController::class, 'index'],
    ],
    'POST' => [
      '/signin' => [AuthController::class, 'createUser']
    ]
  ];
  ?>