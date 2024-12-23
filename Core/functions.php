
<?php

function base_path($path)
{


    return __DIR__ . "/../" . $path;
}


// cria um contexto diferente quando é dentro de uma funcao, por isso preciso passar os dados de dentro da funcao para o require
function view($view, $dados = [], $template = 'app')
{

    foreach ($dados as $key => $value) {

        $$key = $value;
    }

    require  base_path("views/template/$template.php");
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

    return new Core\Flash;
}

function config()
{

    require 'credentials.php';


    return $config;
}

function old($field)
{

    $post = $_POST;

    if (isset($post[$field])) {
        return $post[$field];
    }

    return '';
}

function redirect($uri)
{
    return header('location:' . $uri);
}
