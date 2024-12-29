<?php

namespace App\Models;

use Core\Database;

class Nota
{
    public $id;

    public $usuario_id;

    public $titulo;

    public $nota;

    public $data_criacao;

    public $data_update;

    public static function all($filter = null)
    {

        $database = new Database(config());

        return $database->query(
            ('select * from notas where usuario_id = :usuario_id'.($filter ? ' and titulo like :filter' : null)),
            self::class,
            array_merge(['usuario_id' => $_SESSION['auth']->id], $filter ? ['filter' => "%$filter%"] : [])
        )->fetchAll();
    }
}
