
<?php

use App\Controllers\Notas\IndexController;
use App\Models\Nota;

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


function getResultsRequestUri($arrayUri)
{

    $queryUri = explode('=', $arrayUri['query']);

    if ($queryUri[0] == 'search') {

        $notas = Nota::all($queryUri[1]);

        if ($notas) {
            return   ['notas' => $notas, 'selectedNote' => $notas[0]];
        } else {
            return view('notas/not_found', ['notas' => $notas]);
        }
    } else {

        $notas = Nota::all();


        return ['notas' => $notas, 'selectedNote' => IndexController::getSelectedNote($notas, $queryUri)];
    }
}
