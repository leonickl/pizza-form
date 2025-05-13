<?php

namespace App\Lib;

class App
{
    public static function run()
    {
        Session::start();

        $page = Router::route()
            ->layout('app')
            ->render();

        Session::stop();

        return $page;
    }
}