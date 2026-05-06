<?php

namespace App\Controllers;

use PXP\Http\Controllers\Controller;
use PXP\Http\Response\View;
use PXP\Lib\Auth;

class ProfileController extends Controller
{
    public function index(): View
    {
        return view('profile', [
            'user' => Auth::user(),
        ]);
    }
}
