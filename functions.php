<?php

function dd(mixed ...$data)
{
    echo '<pre>';
    var_dump(...$data);
    echo '</pre>';
    
    die();
}

function view(string $view, array $params = [])
{
    return \App\Lib\View::make($view, $params);
}