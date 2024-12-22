<?php

namespace App\Controllers;

use Core\Validation;
use Core\Database;

class RegisterController
{

    public function index()
    {
        return view('register');
    }

    public function register()
    {
        $validation = Validation::toValidate([
            'name' => ['required'],
            'email' => [
                'required',
                'unique',
                'email',
                'confirmed',
            ],
            'password' => ['required', 'min', 'strong']
        ], $_POST);

        if ($validation->notPass()) {

            return view('register');
        }

        $database = new Database(config());

        $database->query(
            'insert into usuarios (nome,email,senha) values (:nome,:email,:senha)',
            null,
            [
                'nome' => $_POST['name'],
                'email' => $_POST['email'],
                'senha' => password_hash($_POST['password'], PASSWORD_DEFAULT),
            ]
        );


        flash()->push('message', 'Cadastrado com sucesso!');
        return redirect("login");
    }
}
