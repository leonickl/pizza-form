<?php

namespace App\Controllers;

use App\Models\User;
use PXP\Http\Controllers\Controller;
use PXP\Http\Response\Redirect;
use PXP\Http\Response\Response;

class RegisterController extends Controller
{
    public function form(): Response
    {
        return view('register', [
            'errors' => session()->take('errors'),
        ]);
    }

    public function register(): Response
    {
        $request = request()->validate(fn ($req) => [
            $req->email->string()->email()->min(6)->max(50),
            $req->name->string()->min(3)->max(40),
            $req->password->string()->min(8)->max(100),
        ]);

        if (User::findAllBy('username', $request->email)->count() > 0) {
            return Redirect::back([
                'errors' => 'Diese E-Mail-Adresse ist schon registriert.',
            ]);
        }

        User::create(
            name: $request->name,
            username: $request->email,
            password_hash: password_hash($request->password, PASSWORD_DEFAULT),
        );

        return Redirect::route('login', [
            'errors' => ["Benutzer '$request->name' ($request->email) wurde erstellt. Bitte E-Mail-Adresse verifizieren."],
        ]);
    }
}
