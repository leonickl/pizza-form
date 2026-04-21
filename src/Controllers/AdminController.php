<?php

namespace App\Controllers;

use App\Day;
use App\Models\Order;
use PXP\Data\DB;
use PXP\Exceptions\UnauthorizedException;
use PXP\Http\Controllers\Controller;
use PXP\Http\Response\Redirect;

class AdminController extends Controller
{
    private function guard(string $secret)
    {
        if ($secret !== config('secret')) {
            throw new UnauthorizedException;
        }
    }

    public function index(string $secret)
    {
        $this->guard($secret);

        return view('admin', [
            'orders' => Order::all()
                ->sort(fn ($a, $b) => $b->paid <=> $a->paid ?: $b->name <=> $a->name),
            'deleted' => session()->take('deleted'),
            'restored' => session()->take('restored'),
            'paid' => session()->take('paid'),
        ]);
    }

    public function destroy(string $secret)
    {
        $this->guard($secret);

        $id = (int) request('id');

        $order = Order::find($id);

        $order->delete();

        return Redirect::path('/admin/'.config('secret'), [
            'deleted' => $order,
        ]);
    }

    public function restore(string $secret)
    {
        $this->guard($secret);

        $id = (int) request('id');

        DB::init()->restore('orders', $id);

        return Redirect::path('/admin/'.config('secret'), [
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

        $ordersWithoutDay = Order::all()
            ->filter(fn (Order $order) => $order->days === 0);

        $days[] = (object) [
            'day' => null,
            'types' => $ordersWithoutDay->groupBy(fn ($order) => $order->type),
            'total' => $ordersWithoutDay->count(),
        ];

        return view('analysis', compact('days'));
    }

    public function togglePaid(string $secret)
    {
        $this->guard($secret);

        $id = (int) request('id');

        $order = Order::find($id);

        $order->paid = ! $order->paid;

        $order->save();

        return Redirect::path('/admin/'.config('secret'), [
            'paid' => $order,
        ]);
    }

    public function toggleAccessiblity(string $secret)
    {
        $this->guard($secret);

        perma(['accessible' => ! perma('accessible', false)]);

        return Redirect::path('/admin/'.config('secret'));
    }
}
