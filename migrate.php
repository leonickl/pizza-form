<?php

use PXP\Core\Lib\DB;

require __DIR__.'/vendor/autoload.php';

$db = DB::init();

$db->create('orders', [
    'name' => 'text not null',
    'type' => 'text',
    'extra' => 'text',
]);

$db->addColumns('orders', [
    'paid' => 'boolean not null default 0',
    'email' => 'text',
]);

$db->addColumns('orders', [
    'days' => 'int not null default 0',
]);
