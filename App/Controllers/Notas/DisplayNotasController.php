<?php

namespace App\Controllers\Notas;

use Core\Validation;

class DisplayNotasController
{
    public function mostrar()
    {

        $_SESSION['mostrar'] = true;

        $validation = Validation::toValidate([
            'password' => [
                'required',
            ],
        ], $_POST);

        if ($validation->notPass()) {
            return view('notas/confirm');
        }

        if (! password_verify($_POST['password'], $_SESSION['auth']->senha)) {

            flash()->push('validation', ['password' => ['Senha estão incorretos.']]);

            return view('notas/confirm');
        }

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

    public function confirm()
    {
        return view('notas/confirm');
    }
}
