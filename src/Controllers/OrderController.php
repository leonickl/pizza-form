<?php

namespace App\Controllers;

use App\Day;
use App\Models\Order;
use PXP\Http\Response\Redirect;
use PXP\Http\Response\Response;
use PXP\Lib\Auth;

class OrderController
{
    public function index(): Response
    {
        if (! perma('accessible', false)) {
            return view('orders-closed');
        }

        return view('main', [
            'order' => session()->take('order'),
        ]);
    }

    public function action(): Response
    {
        $user = Auth::user();

        $person = $user === null
            ? request()->validate(fn ($req) => [
                $req->name->string()->min(3)->max(40),
                $req->email->string()->email()->min(6)->max(50),
            ])
            : o(user_id: $user->id, name: '', email: '');

        $data = request()->validate(fn ($req) => [
            $req->type->string()->in('Vegan', 'Vegetarisch', 'Alles'),
            $req->extra->string()->nullable()->max(100),
            $req->days->array()->nullable(),
        ]);

        $data->days = count(config('days')) === 1
            ? array_first(config('days'))->value
            : Day::combine(
                v(...array_values($data->days ?? []))
                    ->map(fn ($day) => Day::from((int) $day)),
            );

        return Redirect::route('main', [
            'order' => Order::create(
                ...$data->toArray(),
                ...$person->toArray(),
                paid: false,
            ),
        ]);
    }
}
