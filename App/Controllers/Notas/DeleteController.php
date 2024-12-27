<?php

namespace App\Controllers\Notas;

use Core\Database;


class DeleteController
{

    public function __invoke()
    {



        $database = new Database(config());


        $database->query(
            "delete from notas where id = :id",
            null,
            [
                'id' => $_POST['id_selected']
            ]
        );


        redirect("/notas");
    }
}
