<?php

namespace App\Middlewares;

class GuestMiddleware
{

    public function handle()
    {

        if (isset($_SESSION['auth'])) {

            return redirect('/notas');
        }
    }
}
