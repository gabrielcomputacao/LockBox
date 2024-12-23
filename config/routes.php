<?php

use App\Controllers\IndexController;
use App\Controllers\LoginController;
use App\Controllers\DashboardController;
use App\Controllers\LogoutController;
use App\Controllers\RegisterController;
use App\Controllers\Notas\CreateController;
use Core\Routes;

(new Routes())
    ->get('/', IndexController::class)
    ->get('/login', [LoginController::class, 'index'])
    ->get('/dashboard', DashboardController::class)
    ->get('/notas/create', [CreateController::class, 'index'])
    ->get('/logout', LogoutController::class)
    ->get('/register', [RegisterController::class, 'index'])
    ->post('/login', [LoginController::class, 'login'])
    ->post('/register', [RegisterController::class, 'register'])
    ->post('/notas/create', [CreateController::class, 'store'])
    ->run();
