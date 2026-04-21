<?php

use App\Day;

return [
    'title' => 'Pizze',

    'secret' => '90d13090-fa3b-480f-a6d2-3e06fec20954',

    'domain' => env('HOST'),
    'port' => 8085,

    'days' => [
        Day::SATURDAY,
        Day::SUNDAY,
    ],
];
