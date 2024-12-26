<?php

namespace App\Controllers\Notas;

use App\Models\Nota;

class IndexController
{

    public function __invoke()
    {

        $notas = Nota::all();

        $uri_notas = explode('=', $_SERVER['REQUEST_URI']);

        if (isset($uri_notas[1])) {

            $uniqueNote = array_filter($notas, fn($note) =>  $note->id == $uri_notas[1]);

            $selectedNote = array_pop($uniqueNote);
        } else {
            $selectedNote = $notas[0];
        }


        return view('notas', ['notas' => $notas, 'selectedNote' => $selectedNote]);
    }
}
