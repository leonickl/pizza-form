<?php

namespace App\Controllers;

use PXP\Auth\Auth;
use PXP\Http\Controllers\Controller;
use PXP\Http\Response\View;

class MyController extends Controller
{
    public function index(): View
    {
        return view('my', [
            'user' => Auth::user(),
        ]);
    }
}
