<?php

namespace App\Controllers;

class DashboardController
{

    public function __invoke()
    {

        if (! $_SESSION['auth']) {
            return redirect('login');
        }

        return view('dashboard', ['user' => $_SESSION['auth']]);
    }
}
