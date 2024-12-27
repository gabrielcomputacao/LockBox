<?php

namespace App\Controllers\Notas;

use Core\Database;
use Core\Validation;

class UpdateController
{

    public function __invoke()
    {

        $validation = Validation::toValidate([
            'titulo' => [
                'required',
            ],
            'nota' => ['required'],
            'id_selected' => ['required']
        ], $_POST);


        if ($validation->notPass()) {
            return redirect('/notas?id=' . $_POST['id_selected']);
        }



        $database = new Database(config());


        $database->query(
            "update notas set titulo = :titulo, nota = :nota where id = :id",
            null,
            [
                'titulo' => $_POST['titulo'],
                'nota' => $_POST['nota'],
                'id' => $_POST['id_selected']
            ]
        );


        redirect("/notas");
    }
}
