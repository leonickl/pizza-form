<?php

return [
    'domain' => 'pizza.leonickl.de',

    'routes' => [
        '/' => [
            'GET' => [\App\Controllers\OrderController::class, 'index'],
            'POST' => [\App\Controllers\OrderController::class, 'action'],
        ],
        '/admin/{secret}' => [
            'GET' => [\App\Controllers\AdminController::class, 'index'],
        ],
        '/admin/{secret}/analysis' => [
            'GET' => [\App\Controllers\AdminController::class, 'analysis'],
        ],
        '/admin/{secret}/delete' => [
            'POST' => [\App\Controllers\AdminController::class, 'destroy'],
        ],
        '/admin/{secret}/toggle-paid' => [
            'POST' => [\App\Controllers\AdminController::class, 'togglePaid'],
        ],
    ],
];
