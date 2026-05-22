<?php

use App\Models\User;
use PXP\Console\Command;

Command::new('create:user', function (?string $name, ?string $email, ?string $password, string $role = '0') {
    if ($name === null) {
        exit("Please enter a name\n");
    }

    if ($email === null) {
        exit("Please enter an email address\n");
    }

    if ($password === null) {
        exit("Please enter a password\n");
    }

    $user = User::create(
        name: $name,
        username: $email,
        password_hash: password_hash($password, PASSWORD_DEFAULT),
        role: (int) $role,
    );

    echo "created user with id $user->id\n";
});
