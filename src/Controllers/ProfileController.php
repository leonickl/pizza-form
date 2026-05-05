<?php

namespace App\Controllers;

use PXP\Http\Controllers\Controller;
use PXP\Lib\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile', [
            'user' => Auth::user(),
        ]);
    }
}
