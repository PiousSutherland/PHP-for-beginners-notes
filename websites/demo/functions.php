<?php
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
