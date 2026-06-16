<?php

use App\Controllers\UserController;
use App\Controllers\HomeController;
use App\Controllers\AuthController;
use App\Middlewares\AuthMiddleware;
use App\Middlewares\LoggerMiddleware;

return [
  'GET' => [
    '/' => [
        'action' => [HomeController::class, 'index'],
        'middlewares' => []
    ],
    '/login' => [
        'action' => [AuthController::class, 'login'],
        'middlewares' => []
    ],
    '/signin' => [
        'action' => [AuthController::class, 'signin'],
        'middlewares' => []
    ],
    '/users' => [
        'action' => [UserController::class, 'index'],
        'middlewares' => [LoggerMiddleware::class, AuthMiddleware::class] // Protegido!
    ],
  ],
  'POST' => [
    '/signin' => [
        'action' => [AuthController::class, 'createUser'],
        'middlewares' => [LoggerMiddleware::class]
    ]
  ]
];