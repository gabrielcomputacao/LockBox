<?php

namespace App\Controllers\Notas;

class DisplayNotasController
{

    public function mostrar()
    {

        $_SESSION['mostrar'] = true;

        return redirect('/notas');
    }


    public function esconder()
    {

        unset($_SESSION['mostrar']);
        return redirect('/notas');
    }
}
