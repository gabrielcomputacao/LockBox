<?php

namespace App\Controllers\Notas;

use Core\Database;
use Core\Validation;

class CreateController
{
    public function index()
    {
        return view('notas/create');
    }

    public function store()
    {

        $validation = Validation::toValidate([
            'titulo' => [
                'required',
            ],
            'nota' => ['required'],
        ], $_POST);

        if ($validation->notPass()) {
            return view('notas/create', []);
        }

        $database = new Database(config());

        $database->query(
            'insert into notas (usuario_id,titulo,nota,data_criacao,data_update) values (:usuario_id,:titulo,:nota,:data_criacao,:data_update) ',
            null,
            [
                'usuario_id' => $_SESSION['auth']->id,
                'titulo' => $_POST['titulo'],
                'nota' => secured_encrypt($_POST['nota']),
                'data_criacao' => date('Y-m-d H:i:s'),
                'data_update' => date('Y-m-d H:i:s'),
            ]
        );

        flash()->push('message', 'nota criada com sucesso!');

        redirect('/notas');
    }
}
