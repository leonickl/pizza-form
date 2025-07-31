<?php

namespace App\Lib;

class Router
{
    public static function route()
    {
        $uri = '/' . trim($_SERVER['REQUEST_URI'], "/\r\n\t ");

        $path = parse_url($uri, PHP_URL_PATH);

        $method = $_SERVER['REQUEST_METHOD'];

        @[$class, $function, $params] = self::find($path, $method);

        return (new $class)->{$function}(...$params ?? []);
    }

    private static function find(string $path, string $method)
    {
        $routes = config('routes');

        $tree = RouteTree::build($routes);

        $endpoint = $tree->find($path);

        if($endpoint === null) {
            return [\App\Controllers\ErrorController::class, 'notFound', [$path]];
        }

        $action = $endpoint->method($method);

        if ($action === null) {
            return [\App\Controllers\ErrorController::class, 'methodNotSupported', [$path, $method]];
        }

        return $action;
    }

    public static function redirect(string $uri, array $data = [])
    {
        if ($data) {
            Session::setAll($data);
        }

        header("location: $uri");
    }
}