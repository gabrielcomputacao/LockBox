<?php



require 'Validation.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

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

        header('location: /Book-Store/login');
        exit();
    }

    // A funcao filter_var tem varias validacoes ja embutidas que retornam true se passa da valicação
    // nesse exemplo foi a validação se é um email valido



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
    header("location: /login");
    exit();
}

header("location: /login");
exit();
