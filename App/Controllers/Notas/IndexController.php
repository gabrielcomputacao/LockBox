<?php

namespace App\Controllers\Notas;

class IndexController
{

    public function __invoke()
    {

        if (! $_SESSION['auth']) {
            return redirect('login');
        }

        return view('notas', ['user' => $_SESSION['auth']]);
    }
}
