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
    public function index()
    {
        return view('admin', [
            'orders' => Order::all()
                ->sort(fn ($a, $b) => $b->paid <=> $a->paid ?: $b->name <=> $a->name),
            'deleted' => session()->take('deleted'),
            'restored' => session()->take('restored'),
            'paid' => session()->take('paid'),
        ]);
    }

    public function destroy()
    {
        $id = (int) request('id');

        $order = Order::find($id);

        $order->delete();

        return Redirect::path('/admin', [
            'deleted' => $order,
        ]);
    }

    public function restore()
    {
        $id = (int) request('id');

        DB::init()->restore('orders', $id);

        return Redirect::path('/admin', [
            'restored' => Order::find($id),
        ]);
    }

    public function analysis()
    {
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

    public function togglePaid()
    {
        $id = (int) request('id');

        $order = Order::find($id);

        $order->paid = ! $order->paid;

        $order->save();

        return Redirect::path('/admin/', [
            'paid' => $order,
        ]);
    }

    public function toggleAccessiblity()
    {
        perma(['accessible' => ! perma('accessible', false)]);

        return Redirect::path('/admin/');
    }
}
