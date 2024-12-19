<?php



/* $partsUrl = parse_url($_SERVER['REQUEST_URI']);

$livros = '';

$queryStringPesquisar = [];

if (isset($partsUrl['query'])) {
    parse_str($partsUrl['query'], $queryStringPesquisar);
}

if (isset($queryStringPesquisar['pesquisar'])) {
    $valuePesquisar = $queryStringPesquisar['pesquisar'];
    // database foi instanciado dentro da classe e passado para todos usarem essa unica instancia
    $livros = $database->query("select * from livros
                where
                titulo like :pesquisa
                or descricao like :pesquisa
                or autor like :pesquisa
            ", null, ['pesquisa' => "%$valuePesquisar%"]);
} else {
    $livros = Livro::all();
} */



view('index');
