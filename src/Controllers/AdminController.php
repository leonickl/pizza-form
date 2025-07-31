<?php

namespace App\Controllers;

use App\Exceptions\UnauthorizedException;
use App\Lib\Router;

class AdminController
{
    private function guard(string $secret)
    {
        if($secret !== '90d13090-fa3b-480f-a6d2-3e06fec20954') {
            throw new UnauthorizedException;
        }
    }

    public function index(string $secret)
    {
        $this->guard($secret);

        return view('admin', [
            'orders' => \App\Models\Order::all()
                ->sort(fn($a, $b) => $b->paid <=> $a->paid ?: $b->name <=> $a->name),
        ]);
    }

    public function destroy(string $secret)
    {
        $this->guard($secret);

        $id = (int) request('id');

        $order = \App\Models\Order::find($id);
        
        $order->delete();

        return Router::redirect('/90d13090-fa3b-480f-a6d2-3e06fec20954', [
            'deleted' => $order,
        ]);
    }

    public function analysis(string $secret)
    {
        $this->guard($secret);

        $orders = \App\Models\Order::all();

        return view('analysis', [
            'types' => $orders->groupBy(fn($order) => $order->type),
            'total' => $orders->count(),
        ]);
    }

    public function togglePaid(string $secret)
    {
        $this->guard($secret);

        $id = (int) request('id');

        $order = \App\Models\Order::find($id);
        
        $order->paid = ! $order->paid;

        $order->save();

        return Router::redirect('/90d13090-fa3b-480f-a6d2-3e06fec20954', [
            'paid' => $order,
        ]);
    }
}