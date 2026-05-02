<?php

namespace App\Controllers;

use App\Day;
use App\Models\Order;
use PXP\Data\DB;
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

    public function trash()
    {
        return view('trash', [
            'orders' => Order::trashed()
                ->sort(fn ($a, $b) => $a->deleted_at <=> $b->deleted_at),
        ]);
    }

    public function destroy(int $id)
    {
        $order = Order::find($id);

        $order->delete();

        return Redirect::route('orders', [
            'deleted' => $order,
        ]);
    }

    public function restore(int $id)
    {
        DB::init()->restore('orders', $id);

        return Redirect::route('orders', [
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

    public function togglePaid(int $id)
    {
        $order = Order::find($id);

        $order->paid = ! $order->paid;

        $order->save();

        return Redirect::route('orders', [
            'paid' => $order,
        ]);
    }

    public function toggleAccess()
    {
        perma(['accessible' => ! perma('accessible', false)]);

        return Redirect::route('orders');
    }
}
