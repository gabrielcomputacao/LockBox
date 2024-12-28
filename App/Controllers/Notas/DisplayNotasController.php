<?php

namespace App\Controllers\Notas;

class DisplayNotasController
{

    public function mostrar()
    {

        $_SESSION['mostrar'] = true;


        $resultId = getIdUrl();

        if (isset($resultId)) {

            return redirect("/notas?id=$resultId");
        }

        return redirect('/notas');
    }


    public function esconder()
    {

        unset($_SESSION['mostrar']);

        $resultId = getIdUrl();

        if (isset($resultId)) {

            return redirect("/notas?id=$resultId");
        }

        return redirect('/notas');
    }
}
