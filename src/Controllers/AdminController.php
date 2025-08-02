<?php

namespace App\Controllers;

use PXP\Core\Controllers\Controller;
use PXP\Core\Lib\Router;

class AdminController extends Controller
{
    private function guard(string $secret)
    {
        if ($secret !== config('secret')) {
            throw new \PXP\Core\Exceptions\UnauthorizedException;
        }
    }

    public function index(string $secret)
    {
        $this->guard($secret);

        return view('admin', [
            'orders' => \App\Models\Order::all()
                ->sort(fn ($a, $b) => $b->paid <=> $a->paid ?: $b->name <=> $a->name),
        ]);
    }

    public function destroy(string $secret)
    {
        $this->guard($secret);

        $id = (int) request('id');

        $order = \App\Models\Order::find($id);

        $order->delete();

        return Router::redirect('/admin/'.config('secret'), [
            'deleted' => $order,
        ]);
    }

    public function analysis(string $secret)
    {
        $this->guard($secret);

        $orders = \App\Models\Order::all();

        return view('analysis', [
            'types' => $orders->groupBy(fn ($order) => $order->type),
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

        return Router::redirect('/admin/'.config('secret'), [
            'paid' => $order,
        ]);
    }
}
