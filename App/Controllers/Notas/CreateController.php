<?php

namespace App\Controllers\Notas;


class CreateController
{

    public function index()

    {
        return view('notas/create');
    }

    public function store()
    {
        dd($_POST);
    }
}
