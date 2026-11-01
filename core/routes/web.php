<?php

use App\Controllers\UserController;
use App\Controllers\HomeController;
use App\Controllers\DashboardController;
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
        'middlewares' => [LoggerMiddleware::class]
    ],
    '/signin' => [
        'action' => [AuthController::class, 'signin'],
        'middlewares' => [LoggerMiddleware::class]
    ],
    '/users' => [
        'action' => [UserController::class, 'index'],
        'middlewares' => [LoggerMiddleware::class, AuthMiddleware::class]
    ],
    '/dashboard' => [
        'action' => [DashboardController::class, 'index'],
        'middlewares' => [LoggerMiddleware::class, AuthMiddleware::class]
    ]
  ],
  'POST' => [
        '/logout' => [
                'action' => [AuthController::class, 'logout'],
                'middlewares' => [LoggerMiddleware::class]
        ],
    '/signin' => [
        'action' => [AuthController::class, 'createUser'],
        'middlewares' => [LoggerMiddleware::class]
    ],
    '/login' => [
        'action' => [AuthController::class, 'authenticateUser'],
        'middlewares' => [LoggerMiddleware::class]
    ]
  ]
];