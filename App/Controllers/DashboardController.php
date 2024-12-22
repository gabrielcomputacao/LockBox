<?php

namespace App\Controllers;

class DashboardController
{

    public function __invoke()
    {

        if (! $_SESSION['auth']) {
            return redirect('login');
        }

        echo "estou logado" .  $_SESSION['auth']->nome;
    }
}
