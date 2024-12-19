<?php




if ($_SERVER['REQUEST_METHOD'] == 'POST') {


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

        header('location: /login');
        exit();
    }

    $user = $database->query("
    select * from usuarios where
    email = :email
    ", User::class, [
        'email' => $email,
    ])->fetch();


    if ($user) {

        $dataPassword = $user->senha;

        if (! password_verify($password, $dataPassword)) {
            flash()->push('validation', ['Usuário ou senha estão incorretos.']);
            header('location: /login');
            exit();
        }


        $_SESSION['auth'] = $user;
        header('location: /');
        exit();
    }
}



view('login');
