
<?php

use App\Controllers\Notas\IndexController;
use App\Models\Nota;

function base_path($path)
{

    return __DIR__.'/../'.$path;
}

// cria um contexto diferente quando é dentro de uma funcao, por isso preciso passar os dados de dentro da funcao para o require
function view($view, $dados = [], $template = 'app')
{

    foreach ($dados as $key => $value) {

        $$key = $value;
    }

    require base_path("views/template/$template.php");
}

function dd($dump)
{

    echo '<pre>';

    var_dump($dump);

    echo '<pre/>';

    exit();
}

function abort($code)
{

    http_response_code($code);

    view(404);

    exit();
}

function flash()
{

    return new Core\Flash;
}

function config()
{

    require 'credentials.php';

    return $config;
}

function configSecurity($key)
{

    require 'keys.php';

    $array_key = explode('.', $key);

    return isset($keys[$array_key[0]][$array_key[1]]) ? $keys[$array_key[0]][$array_key[1]] : null;
}

function old($field)
{

    $post = $_POST;

    if (isset($post[$field])) {
        return $post[$field];
    }

    return '';
}

function redirect($uri)
{
    return header('location:'.$uri);
}

function getResultsRequestUri($arrayUri)
{

    $queryUri = explode('=', $arrayUri['query']);

    if ($queryUri[0] == 'search') {

        $notas = Nota::all($queryUri[1]);

        if ($notas) {
            return ['notas' => $notas, 'selectedNote' => $notas[0]];
        } else {
            return view('notas/not_found', ['notas' => $notas]);
        }
    } else {

        $notas = Nota::all();

        return ['notas' => $notas, 'selectedNote' => IndexController::getSelectedNote($notas, $queryUri)];
    }
}

function hideData($value)
{

    return isset($_SESSION['mostrar']) ? $value : str_repeat('*', strlen($value));
}

function secured_encrypt($data)
{
    $first_key = base64_decode(configSecurity('security.first_key'));
    $second_key = base64_decode(configSecurity('security.second_key'));

    $method = 'aes-256-cbc';
    $iv_length = openssl_cipher_iv_length($method);
    $iv = openssl_random_pseudo_bytes($iv_length);

    $first_encrypted = openssl_encrypt($data, $method, $first_key, OPENSSL_RAW_DATA, $iv);
    $second_encrypted = hash_hmac('sha3-512', $first_encrypted, $second_key, true);

    $output = base64_encode($iv.$second_encrypted.$first_encrypted);

    return $output;
}

function secured_decrypt($input)
{
    $first_key = base64_decode(configSecurity('security.first_key'));
    $second_key = base64_decode(configSecurity('security.second_key'));
    $mix = base64_decode($input);

    $method = 'aes-256-cbc';
    $iv_length = openssl_cipher_iv_length($method);

    $iv = substr($mix, 0, $iv_length);
    $second_encrypted = substr($mix, $iv_length, 64);
    $first_encrypted = substr($mix, $iv_length + 64);

    $data = openssl_decrypt($first_encrypted, $method, $first_key, OPENSSL_RAW_DATA, $iv);
    $second_encrypted_new = hash_hmac('sha3-512', $first_encrypted, $second_key, true);

    if (hash_equals($second_encrypted, $second_encrypted_new)) {
        return $data;
    }

    return false;
}

function getIdUrl()
{

    $partsUrl = parse_url($_SERVER['REQUEST_URI']);

    $queryUrl = isset($partsUrl['query']) ? explode('=', $partsUrl['query']) : null;

    if ($queryUrl && $queryUrl[0] == 'id') {
        return $queryUrl[1];
    }

    return null;
}

function env($key)
{

    $env = parse_ini_file(base_path('.env'));

    return $env[$key];
}
