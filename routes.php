<?php

use App\Controllers\IndexController;
use App\Controllers\LoginController;
use Core\Routes;

(new Routes())
    ->get('/', IndexController::class)
    ->get('/login', [LoginController::class, 'index'])
    ->post('/login', [LoginController::class, 'login'])
    ->run();

exit();



$controller = 'index';

$urlParts =  parse_url($_SERVER['REQUEST_URI']);

$queryParams = [];

if (isset($urlParts['query'])) {
    parse_str($urlParts['query'], $queryParams);
}


if (
    (isset($_SERVER['REQUEST_URI']) && $_SERVER['REQUEST_URI'] != '/lockbox/')
    || isset($queryParams['id'])
) {
    $uri = str_replace('/', '', $_SERVER['REQUEST_URI']);

    if (isset($queryParams['id']) || isset($queryParams['msg'])) {


        $linkUri = explode('?', $uri);

        $controller = $linkUri[0];
    } else {
        $controller = $uri;
    }
}




if (!file_exists("../controllers/{$controller}.controller.php")) {

    abort(404);
}

// => INGLES: DUMP = jogar fora

// sempre pega o caminho direto da raiz do projeto e nao da pagina em questao
require "../controllers/{$controller}.controller.php";
