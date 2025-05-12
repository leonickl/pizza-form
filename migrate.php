<?php

require __DIR__ . '/vendor/autoload.php';

$db = \App\Lib\DB::init();

$db->create('orders', [
    'id' => 'integer primary key',
    'name' => 'text not null',
    'type' => 'text',
    'extra' => 'text',
]);
