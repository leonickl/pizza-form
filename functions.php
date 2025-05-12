<?php

use App\Lib\Collection;

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

function c(mixed ...$items)
{
    return Collection::make($items);
}