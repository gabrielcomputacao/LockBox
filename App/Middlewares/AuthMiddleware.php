<?php

namespace App\Middlewares;

class AuthMiddleware
{

    public function handle()
    {

        if (!$_SESSION['auth']) {

            return redirect('/login');
        }
    }
}
