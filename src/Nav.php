<?php

namespace App;

use App\Enums\Role;
use PXP\Lib\Auth;

class Nav
{
    protected function items()
    {
        $user = Auth::user();

        return [
            o(at: ['/login', '/register', '/profile', '/orders'], to: route('main'), how: 'Formular', classes: 'secondary'),

            o(at: ['/'], to: route('login'), how: 'Login', guard: fn () => $user === null, classes: 'secondary'),
            o(at: ['/', '/orders/trash'], to: route('orders'), how: 'Bestellungen', guard: fn () => $user && $user->is(Role::ADMIN)),
            o(at: ['/', '/orders'], to: route('profile'), how: 'Mein Account', guard: fn () => $user),

            o(at: ['/login'], to: route('register'), how: 'Registrieren'),

            o(at: ['/orders'], to: route('trash'), how: 'Papierkorb', guard: fn () => $user && $user->is(Role::ADMIN)),
            o(at: ['/orders'], to: route('analysis'), how: 'Analyse', guard: fn () => $user && $user->is(Role::ADMIN)),
            o(at: ['/orders'], to: route('toggle-access').'?__method=post', how: 'Zugang umschalten',
                guard: fn () => $user && $user->is(Role::ADMIN), style: 'background-color: '.(perma('accessible', false) ? 'lightgreen' : 'red')),

            o(at: ['/analysis'], to: route('orders'), how: 'Zurück', guard: fn () => $user && $user->is(Role::ADMIN)),

            o(at: ['*'], to: route('logout'), how: 'Logout', classes: 'warn', guard: fn () => $user),
        ];
    }

    public function __toString()
    {
        $links = '';

        foreach ($this->items() as $item) {
            $allow_url = in_array('*', $item->at) || in_array(url(), $item->at);

            if ($allow_url && ($item->guard ?? fn () => true)()) {
                $classes = $item->classes ?? '';
                $style = $item->style ?? '';

                $links .= "<a class=\"btn $classes\" href=\"$item->to\" style=\"$style\">$item->how</a>";
            }
        }

        return $links;
    }
}
