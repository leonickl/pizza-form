<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\VerificationLink;
use PXP\Exceptions\DisplayException;
use PXP\Http\Controllers\Controller;
use PXP\Http\Response\Redirect;

class VerificationController extends Controller
{
    public function verify()
    {
        $token = request()->string('token');

        $link = VerificationLink::findByOrNull('token', $token) ??
            error(DisplayException::class, 'Ungültiger Token');

        $link->isValid() ?:
            error(DisplayException::class, 'Token abgelaufen');

        User::find($link->user_id)->fill(verified: true)->save();

        return Redirect::route('login', [
            'errors' => 'E-Mail-Adresse erfolgreich verifiziert. Du kannst dich jetzt einloggen.',
        ]);
    }
}
