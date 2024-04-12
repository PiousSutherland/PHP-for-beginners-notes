<?php

use Core\Response;

function urlIs($value)
{
    return $_SERVER['REQUEST_URI'] == $value;
}

function dd($value)
{
    echo '<pre>';
    var_dump($value);
    echo '</pre>';
}

function authorize($authorized, $status = Response::FORBIDDEN)
{
    if (!$authorized)
        abort($status);
}

function base_path($path)
{
    return BASE_PATH . $path;
}

function view($path, $attributes = [])
{
    extract($attributes);
    require base_path('views/' . $path);
}
function abort($code = Response::NOT_FOUND)
{
    http_response_code($code);
    view('error.php', ['heading' => $code]);

    die();
}

function login($user)
{
    $_SESSION['user'] = ['email' => $user['email']];

    session_regenerate_id(true);
}

function logout()
{
    $_SESSION = [];
    session_destroy();

    $params = session_get_cookie_params();
    setcookie('PHPSESSID', '', time() - 3600, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
}
