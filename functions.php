<?php

use App\Lib\Collection;

function dump(mixed ...$data)
{
    echo '<pre>';

    if ($data) {
        var_dump(...$data);
    }

    echo '</pre>';
}

function dd(mixed ...$data)
{
    dump(...$data);

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

function obj(mixed ...$values)
{
    return (object) $values;
}

function request(string|array|null $key = null)
{
    if ($key === null) {
        return new \App\Lib\Arrays($_REQUEST);
    }

    return (new \App\Lib\Arrays($_REQUEST))->access($key);
}

function session(string|array|null $key = null)
{
    return (new \App\Lib\Arrays($_SESSION))->access($key);
}

function e(string|null $string)
{
    return htmlspecialchars($string ?? '');
}