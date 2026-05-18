<?php

use App\Day;

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
];
