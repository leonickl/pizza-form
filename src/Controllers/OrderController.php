<?php

namespace App\Controllers;

use PXP\Core\Lib\Router;
use PXP\Core\Lib\Session;

class OrderController
{
    public function index()
    {
        if(! perma('accessible', false)) {
            return view('orders-closed');
        }

        return view('main', [
            'order' => Session::take('order'),
        ]);
    }

    public function action()
    {
        $request = (array) request(['name', 'email', 'type', 'extra']);

        $order = \App\Models\Order::create(...$request, paid: false);

        return Router::redirect(request()->bool('embedded') ? '/?embedded' : '/', compact('order'));
    }
}
