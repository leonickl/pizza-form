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

        return (new $class)->{$function}(...($params ?? []));
    }

    private static function find(string $path, string $method)
    {
        $routes = [
            '/' => [
                'GET' => [\App\Controllers\OrderController::class, 'index'],
                'POST' => [\App\Controllers\OrderController::class, 'action'],
            ],
            '/90d13090-fa3b-480f-a6d2-3e06fec20954' => [
                'GET' => [\App\Controllers\AdminController::class, 'index'],
            ]
        ];

        if (!array_key_exists($path, $routes)) {
            return [\App\Controllers\ErrorController::class, 'notFound', [$path]];
        }

        if (!array_key_exists($method, $routes[$path])) {
            return [\App\Controllers\ErrorController::class, 'methodNotSupported', [$path, $method]];
        }

        return $routes[$path][$method];
    }

    public static function redirect(string $uri, array $data = [])
    {
        if ($data) {
            Session::setAll($data);
        }

        header("location: $uri");
    }
}