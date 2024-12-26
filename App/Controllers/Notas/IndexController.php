<?php

namespace App\Controllers\Notas;

use App\Models\Nota;

class IndexController
{

    public function __invoke()
    {



        $arrayUri = parse_url($_SERVER['REQUEST_URI']);

        if (isset($arrayUri['query'])) {

            $queryUri = explode('=', $arrayUri['query']);

            if ($queryUri[0] == 'search') {

                $notas = Nota::all($queryUri[1]);

                if ($notas) {
                    $selectedNote =   $notas[0];
                } else {
                    return view('notas/not_found', ['notas' => $notas]);
                }
            } else {

                $notas = Nota::all();

                $uniqueNote = array_filter($notas, fn($note) =>  $note->id == $queryUri[1]);

                $selectedNote = array_pop($uniqueNote);
            }
        } else {

            $notas = Nota::all();

            $selectedNote = $notas[0];
        }


        return view('notas', ['notas' => $notas, 'selectedNote' => $selectedNote]);
    }
}
