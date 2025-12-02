<?php

namespace App\Controllers;

use App\Day;
use App\Models\Order;
use PXP\Core\Controllers\Controller;
use PXP\Core\Lib\Router;
use PXP\Core\Lib\Session;

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
            'orders' => Order::all()
                ->sort(fn ($a, $b) => $b->paid <=> $a->paid ?: $b->name <=> $a->name),
            'deleted' => Session::take('deleted'),
            'restored' => Session::take('restored'),
            'paid' => Session::take('paid'),
        ]);
    }

    public function destroy(string $secret)
    {
        $this->guard($secret);

        $id = (int) request('id');

        $order = Order::find($id);

        $order->delete();

        return Router::redirect('/admin/'.config('secret'), [
            'deleted' => $order,
        ]);
    }

    public function restore(string $secret)
    {
        $this->guard($secret);

        $id = (int) request('id');

        \PXP\Core\Lib\DB::init()->restore('orders', $id);

        return Router::redirect('/admin/'.config('secret'), [
            'restored' => Order::find($id),
        ]);
    }

    public function analysis(string $secret)
    {
        $this->guard($secret);

        $days = [];

        foreach (Day::all() as $day) {
            $orders = Order::all()
                ->filter(fn (Order $order) => $order->days & $day->value);

            $days[] = (object) [
                'day' => $day,
                'types' => $orders->groupBy(fn ($order) => $order->type),
                'total' => $orders->count(),
            ];
        }

        return view('analysis', compact('days'));
    }

    public function togglePaid(string $secret)
    {
        $this->guard($secret);

        $id = (int) request('id');

        $order = Order::find($id);

        $order->paid = ! $order->paid;

        $order->save();

        return Router::redirect('/admin/'.config('secret'), [
            'paid' => $order,
        ]);
    }

    public function toggleAccessiblity(string $secret)
    {
        $this->guard($secret);

        perma(['accessible' => ! perma('accessible', false)]);

        return Router::redirect('/admin/'.config('secret'));
    }
}
