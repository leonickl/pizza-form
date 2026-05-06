<?php

use App\Day;

return [
    'title' => 'Pizze',

    'domain' => env('HOST'),
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

    'resend-api-key' => env('RESEND_API_KEY'),

    'mail' => (object) [
        'host' => env('MAIL_HOST'),
        'user' => env('MAIL_USER'),
        'pass' => env('MAIL_PASS'),
        'port' => env('MAIL_PORT'),
    ],
];
