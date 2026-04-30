<?php

namespace App\Controllers;

use PXP\Http\Controllers\Controller;
use PXP\Http\Response\Redirect;
use PXP\Http\Response\Response;
use PXP\Lib\Auth;

class LoginController extends Controller
{
    public function form(): Response
    {
        return view('login');
    }

    public function login(): Response
    {
        $request = request(['username', 'password']);

        validate($request->username, 'username')->string();
        validate($request->password, 'password')->string();

        Auth::login($request->username, $request->password);

        return Redirect::path('/admin');
    }

    public function logout(): Response
    {
        Auth::logout();

        return Redirect::path('/');
    }
}
