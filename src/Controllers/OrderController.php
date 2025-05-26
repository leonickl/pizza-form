<?php

namespace App\Controllers;

use App\Lib\Router;

class OrderController
{
    public function index()
    {
        return view('main');
    }

    public function action()
    {
        $request = (array) request(['name', 'type', 'extra']);

        $order = \App\Models\Order::create(...$request);

        return Router::redirect(request()->bool('embedded') ? '/?embedded' : '/', compact('order'));
    }
}