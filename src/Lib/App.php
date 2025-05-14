<?php

namespace App\Lib;

class App
{
    public static function run()
    {
        Session::start();

        try {
            $page = Router::route()
                ->layout('app')
                ->render();
        } catch (\Exception $e) {
            $class = $e::class;
            $msg = $e->getMessage();
            $file = $e->getFile();
            $line = $e->getLine();

            Log::log("Error ($class): $msg in $file on line $line");

            $page = \App\Lib\View::make('error')->layout('app')->render();
        }

        Session::stop();


        return $page;
    }
}