<?php

use App\Controllers\IndexController;
use App\Controllers\LoginController;
use App\Controllers\Notas;
use App\Controllers\LogoutController;
use App\Controllers\RegisterController;
use App\Controllers\Notas\CreateController;
use App\Controllers\Notas\UpdateController;
use App\Middlewares\AuthMiddleware;
use App\Middlewares\GuestMiddleware;
use Core\Routes;

// nao autenticados
(new Routes())
    ->get('/', IndexController::class, GuestMiddleware::class)
    ->get('/login', [LoginController::class, 'index'], GuestMiddleware::class)
    ->get('/register', [RegisterController::class, 'index'], GuestMiddleware::class)


    ->post('/login', [LoginController::class, 'login'], GuestMiddleware::class)
    ->post('/register', [RegisterController::class, 'register'], GuestMiddleware::class)



    // Autenticados
    ->get('/logout', LogoutController::class, AuthMiddleware::class)
    ->get('/notas', Notas\IndexController::class, AuthMiddleware::class)
    ->get('/notas/create', [CreateController::class, 'index'], AuthMiddleware::class)
    ->post('/notas/create', [CreateController::class, 'store'], AuthMiddleware::class)
    ->put('/nota', UpdateController::class, AuthMiddleware::class)
    ->run();
