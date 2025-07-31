<?php

return [
    'domain' => 'pizza.leonickl.de',

    'routes' => [
        '/' => [
            'GET' => [\App\Controllers\OrderController::class, 'index'],
            'POST' => [\App\Controllers\OrderController::class, 'action'],
        ],
        '/90d13090-fa3b-480f-a6d2-3e06fec20954' => [
            'GET' => [\App\Controllers\AdminController::class, 'index'],
        ],
        '/90d13090-fa3b-480f-a6d2-3e06fec20954/analysis' => [
            'GET' => [\App\Controllers\AdminController::class, 'analysis'],
        ],
        '/90d13090-fa3b-480f-a6d2-3e06fec20954/delete' => [
            'POST' => [\App\Controllers\AdminController::class, 'destroy'],
        ],
        '/90d13090-fa3b-480f-a6d2-3e06fec20954/toggle-paid' => [
            'POST' => [\App\Controllers\AdminController::class, 'togglePaid'],
        ],
    ],
];
