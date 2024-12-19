<?php

// O php processa os dados de cima para baixa e vai passando as variaveis para baixo

$controller = 'index';

$urlParts =  parse_url($_SERVER['REQUEST_URI']);

$queryParams = [];

if (isset($urlParts['query'])) {
    parse_str($urlParts['query'], $queryParams);
}


if (
    isset($_SERVER['REQUEST_URI']) && $_SERVER['REQUEST_URI'] !== '/lockbox'
    || isset($queryParams['id'])
) {
    $uri = str_replace('/lockbox', '', $_SERVER['REQUEST_URI']);

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
