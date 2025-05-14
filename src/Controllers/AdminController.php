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
}