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


    public static function all()
    {

        $database = new Database(config());

        return  $database->query(
            "select * from notas where usuario_id = :usuario_id",
            self::class,
            ['usuario_id' => $_SESSION['auth']->id]
        )->fetchAll();
    }
}
