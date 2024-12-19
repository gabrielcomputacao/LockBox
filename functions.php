
<?php

// cria um contexto diferente quando é dentro de uma funcao, por isso preciso passar os dados de dentro da funcao para o require
function view($view, $dados = [])
{

    foreach ($dados as $key => $value) {

        $$key = $value;
    }

    require 'views/template/app.php';
}

function dd($dump)
{

    echo '<pre>';

    var_dump($dump);

    echo '<pre/>';

    die();
}

function abort($code)
{

    http_response_code($code);

    view(404);

    die();
}

function flash()
{

    return new Flash;
}

function config()
{

    require 'credentials.php';


    return $config;
}
