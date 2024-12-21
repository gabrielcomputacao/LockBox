<?php

namespace App\Controllers;

use Core\Validation;
use Core\Database;
use App\Models\User;

class LoginController
{

    public function index()
    {
        return view('login');
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
            'password' => ['required']
        ], $_POST);


        if ($validation->notPass()) {
            return view('login');
        }

        $database = new Database(config());

        $user = $database->query("
        select * from usuarios where
        email = :email
        ", User::class, [
            'email' => $email,
        ])->fetch();

        if (!($user && ! password_verify($password, $user->senha))) {

            flash()->push('validation', ['email' => ['Usuário ou senha estão incorretos.']]);
            return view('login');
        } else {

            $_SESSION['auth'] = $user;

            flash()->push('message', 'Seja bem bindo' . $user->senha . '!');

            return header('location: /dashboard');
        }
    }
}
