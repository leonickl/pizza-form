<?php

use App\Day;

return [
    'title' => 'Pizze',

    'domain' => env('HOST'),
    'port' => 8085,

    'days' => [
        DayOfWeek::SUNDAY,
    ],
];
