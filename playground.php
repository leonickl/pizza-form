<?php

use App\Models\Order;

// Playground.
// Can be executed with `./run play`

Order::create(
    name: 'John Doe',
    type: 'Vegan',
    extra: 'Funghi',
    paid: true,
);
