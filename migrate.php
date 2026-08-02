<?php

use PXP\Data\DB;

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
    'days' => 'int not null default 0',
]);

$db->create('users', [
    'email' => 'text not null',
    'password_hash' => 'text not null',
]);

$db->addColumns('users', [
    'role' => 'int not null default 0',
    'name' => "string not null default ''",
]);

$db->sql('create unique index if not exists '.
    'unique_users_email on users(email)');

$db->addColumns('orders', [
    'user_id' => 'int references users(id)',
]);

$db->create('verification_link', [
    'token' => 'string not null',
    'user_id' => 'int references user(id)',
]);

$db->addColumns('users', [
    'verified' => 'int not null default 0',
]);

$db->addColumns('orders', [
    'archived_at' => 'datetime',
]);
