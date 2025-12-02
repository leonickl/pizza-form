<?php

namespace App\Controllers;

use App\DayOfWeek;
use PXP\Core\Lib\Router;
use PXP\Core\Lib\Session;

class OrderController
{
    public function index()
    {
        if (! perma('accessible', false)) {
            return view('orders-closed');
        }

        return view('main', [
            'order' => Session::take('order'),
        ]);
    }

    public function action()
    {
        $data = (array) request(['name', 'email', 'type', 'extra']);

        $data['days'] = DayOfWeek::combine(
            c(...request('days') ?? [])
                ->map(fn ($day) => DayOfWeek::from((int) $day)),
        );

        $order = \App\Models\Order::create(...$data, paid: false);

        return Router::redirect('/', compact('order'));
    }
}
