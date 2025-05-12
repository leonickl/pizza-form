<?php

namespace App\Lib;

class App
{
    public static function run()
    {
        return Router::route()
            ->layout('app')
            ->render();
    }
}