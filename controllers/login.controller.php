<?php

use Core\Database;
use Core\Validation;


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $database = new Database($config);

    $email = $_POST['email'];
    $password = $_POST['password'];

    $validation = Validation::toValidate([
        'email' => [
            'required',
            'unique',
            'email',
        ],
        'password' => ['required']
    ], $_POST);


    if ($validation->notPass()) {

        view('login');
        exit();
    }

    $user = $database->query("
    select * from usuarios where
    email = :email
    ", User::class, [
        'email' => $email,
    ])->fetch();


    if ($user && ! password_verify($password, $dataPassword)) {

        $_SESSION['auth'] = $user;
        header('location: /');
        exit();
    } else {
        flash()->push('validation', ['email' => ['Usuário ou senha estão incorretos.']]);
    }
}



view('login');
