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
];
