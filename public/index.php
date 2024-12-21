<?php

require '../Core/functions.php';
require '../Core/credentials.php';

spl_autoload_register(function ($class) {

    $path_class = str_replace('\\', '/', $class);

    require  base_path("{$path_class}.php");
});




session_start();





require '../routes.php';
