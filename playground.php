<?php

// Playground.
// Can be executed with `./run play`

\App\Models\Order::create(
    name: 'John Doe',
    type: 'Vegan',
    extra: 'Funghi',
    paid: true,
);
