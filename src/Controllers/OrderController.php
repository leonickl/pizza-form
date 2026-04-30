<?php

namespace App\Controllers;

use App\Day;
use App\Models\Order;
use PXP\Http\Response\Redirect;

class OrderController
{
    public function index()
    {
        if (! perma('accessible', false)) {
            return view('orders-closed');
        }

        return view('main', [
            'order' => session()->take('order'),
        ]);
    }

    public function action()
    {
        $data = request(['name', 'email', 'type', 'extra', 'days']);

        validate($data->name, 'name')->string()->min(3)->max(40);
        validate($data->email, 'email')->string()->min(6)->max(50);
        validate($data->type, 'type')->string()->in('Vegan', 'Vegetarisch', 'Alles');
        validate($data->extra, 'extra')->string()->nullable()->max(100);
        validate($data->days, 'days')->array()->nullable();

        $data->days = Day::combine(
            v(...array_values($data->days ?? []))
                ->map(fn ($day) => Day::from((int) $day)),
        );

        return Redirect::path('/', [
            'order' => Order::create(...$data->toArray(), paid: false),
        ]);
    }
}
