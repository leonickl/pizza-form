<?php

namespace App\Controllers;

use App\Lib\Router;

class AdminController
{
    public function index()
    {
        return view('admin', ['orders' => \App\Models\Order::all()]);
    }

    public function destroy()
    {
        $id = (int) request('id');

        $order = \App\Models\Order::find($id);
        
        $order->delete();

        return Router::redirect('/90d13090-fa3b-480f-a6d2-3e06fec20954', [
            'deleted' => $order,
        ]);
    }

    public function analysis() {
        $orders = \App\Models\Order::all();
        $types = [];

        foreach($orders->toArray() as $order) {
            if(!isset($types[$order->type])) {
                $types[$order->type] = [];
            }

            $types[$order->type][] = $order->extra;
        }

        return view('analysis', ['types' => $types, 'total' => $orders->count()]);
    }
}