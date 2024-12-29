<?php

namespace App\Controllers;

use App\Models\User;
use Core\Database;
use Core\Validation;

class LoginController
{
    public function index()
    {
        return view('login', [], 'guest');
    }

    public function login()
    {

        $email = $_POST['email'];
        $password = $_POST['password'];

        $validation = Validation::toValidate([
            'email' => [
                'required',
                'email',
            ],
            'password' => ['required'],
        ], $_POST);

        if ($validation->notPass()) {
            return view('login', [], 'guest');
        }

        $database = new Database(config());

        $user = $database->query('
        select * from usuarios where
        email = :email
        ', User::class, [
            'email' => $email,
        ])->fetch();

        if (! ($user && ! password_verify($password, $user->senha))) {

            flash()->push('validation', ['email' => ['Usuário ou senha estão incorretos.']]);

            return view('login', [], 'guest');
        } else {

            $_SESSION['auth'] = $user;

            flash()->push('message', 'Seja bem bindo'.$user->senha.'!');

            return header('location: /notas');
        }
    }
}
