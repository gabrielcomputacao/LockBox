<?php

namespace Core;

use PDO;

class Database
{
    private $db;

    public function __construct($config)
    {
        $this->db = new PDO('mysql:host='.$config['host'].';dbname='.$config['dbname'].';charset=utf8', $config['username'], $config['password']);
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    // so esta usando esse que serve para filtrar, a regra de negocio fica dentro do contorller
    public function query($query, $class = null, $params = [])
    {

        $prepare = $this->db->prepare($query);

        if ($class) {

            $prepare->setFetchMode(PDO::FETCH_CLASS, $class);
        }

        $prepare->execute($params);

        return $prepare;
    }

    // nao esta usando esse
    public function returnLivros($pesquisa = null)
    {

        try {

            $prepare = '';

            if (! isset($pesquisa)) {

                $prepare = $this->db->prepare('select * from livros');

                $prepare->execute();
            } else {
                /*  $sql = "select * from livros
                where
                titulo like '%$pesquisa%'
                or descricao like '%$pesquisa%'
                or autor like '%$pesquisa%'
            "; */

                // metodo para preparar pesquisas para o banco de dados

                $prepare = $this->db->prepare('select * from livros
                where
                titulo like :pesquisa
                or descricao like :pesquisa
                or autor like :pesquisa
            ');
                $prepare->bindValue(':pesquisa', "%$pesquisa%");

                $prepare->execute();
            }

            $items = $prepare->fetchAll();

            // return array_map(fn($item) => Livro::make($item), $items);
        } catch (\Throwable $th) {
            echo 'conexão NÃO deu certo';
        }
    }
}
