<?php

namespace App\Controllers;

use App\Day;
use App\Models\Order;
use PXP\Data\DB;
use PXP\Http\Controllers\Controller;
use PXP\Http\Response\Redirect;
use PXP\Http\Response\Response;

class AdminController extends Controller
{
    public function index(): Response
    {
        return view('orders', [
            'orders' => Order::all()
                ->sort(fn ($a, $b) => $b->paid <=> $a->paid ?: $b->name <=> $a->name),

            'archived' => session()->take('archived'),
            'unarchived' => session()->take('unarchived'),

            'deleted' => session()->take('deleted'),
            'restored' => session()->take('restored'),

            'paid' => session()->take('paid'),
        ]);
    }

    public function trash(): Response
    {
        return view('trash', [
            'orders' => Order::trashed()
                ->sort(fn ($a, $b) => $a->deleted_at <=> $b->deleted_at),

            'restored' => session()->take('restored'),
        ]);
    }

    public function archived(): Response
    {
        return view('archived', [
            'orders' => Order::archived()
                ->sort(fn ($a, $b) => $a->deleted_at <=> $b->deleted_at),

            'unarchived' => session()->take('unarchived'),
            'deleted' => session()->take('deleted'),
        ]);
    }

    public function archive(int $id): Response
    {
        return Redirect::route($this->to('orders'), [
            'archived' => Order::find($id)->archive(),
        ]);
    }

    public function unarchive(int $id): Response
    {
        return Redirect::route($this->to('orders'), [
            'unarchived' => Order::find($id)->unarchive(),
        ]);
    }

    public function destroy(int $id): Response
    {
        $order = Order::find($id);

        $order->delete();

        return Redirect::route($this->to('orders'), [
            'deleted' => $order,
        ]);
    }

    public function restore(int $id): Response
    {
        DB::init()->restore('orders', $id);

        return Redirect::route($this->to('orders'), [
            'restored' => Order::find($id),
        ]);
    }

    public function analysis(): Response
    {
        $days = [];

        foreach (Day::all() as $day) {
            $orders = Order::all()
                ->filter(fn (Order $order) => ($order->days & $day->value) > 0);

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

    public function togglePaid(int $id): Response
    {
        $order = Order::find($id);

        $order->paid = ! $order->paid;

        $order->save();

        return Redirect::route('orders', [
            'paid' => $order,
        ]);
    }

    public function toggleAccess(): Response
    {
        perma(['accessible' => ! perma('accessible', false)]);

        return Redirect::route('orders');
    }

    /**
     * Checks whether the user provided a redirect
     * target and used the default otherwise.
     */
    private function to(string $default): string
    {
        $to = request()->string('to', $default);

        return in_array($to, ['archived', 'unarchived', 'orders', 'trash'])
            ? $to
            : $default;
    }
}
