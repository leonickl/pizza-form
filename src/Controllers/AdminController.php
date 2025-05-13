<?php

namespace App\Controllers;

use App\Lib\Router;

class AdminController
{
    public function index()
    {
        return view('admin', ['orders' => \App\Models\Order::all()]);
    }
}