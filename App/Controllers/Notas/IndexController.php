<?php

namespace App\Controllers\Notas;

use App\Models\Nota;

class IndexController
{

    public function __invoke()
    {


        $arrayUri = parse_url($_SERVER['REQUEST_URI']);

        if (isset($arrayUri['query'])) {

            $getResultsRequest = getResultsRequestUri($arrayUri);
        } else {

            $notas = Nota::all();

            $getResultsRequest = ['notas' => $notas, 'selectedNote' => $notas[0]];
        }


        return view('notas/index', ['notas' => $getResultsRequest['notas'], 'selectedNote' => $getResultsRequest['selectedNote']]);
    }

    public static function getSelectedNote($notas, $queryUri)
    {

        $uniqueNote = array_filter($notas, fn($note) =>  $note->id == $queryUri[1]);

        return  array_pop($uniqueNote);
    }
}
