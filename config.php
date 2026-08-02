<?php

use App\Day;
use App\Models\User;
use PXP\Auth\Models\Identity;

return [
    'title' => 'Pizze',

    'app-url' => env('APP_URL', 'http://localhost:8085'),
    'port' => 8085,

    'days' => [
        Day::SUNDAY,
    ],

    'css' => [
        'media',
        'colors',
        'base',
        'snippets',
        'button',
        'table',
        'notification',
        'components',
        'form',
    ],

    'mail' => (object) [
        'host' => env('MAIL_HOST'),
        'user' => env('MAIL_USER'),
        'pass' => env('MAIL_PASS'),
        'port' => env('MAIL_PORT'),
    ],

    'modules' => [
        'auth' => 'leonickl/pxp-auth',
    ],

    'resolver' => [
        Identity::class => User::class,
    ],
];
