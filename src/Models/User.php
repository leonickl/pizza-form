<?php

namespace App\Models;

use App\Enums\Role;
use PXP\Data\Model;
use PXP\Ds\Vector;

/**
 * @property int $id
 * @property string $username
 * @property string $password_hash
 * @property int $role
 */
class User extends Model
{
    protected string $table = 'users';

    public function setPasswordHash(string $password): void
    {
        $this->password_hash = password_hash($password, PASSWORD_DEFAULT);
    }

    public function role(): Role
    {
        return Role::make($this->role);
    }

    public function is(Role $role): bool
    {
        return $this->role() === $role;
    }

    public function orders(): Vector
    {
        return Order::all()
            ->filter(fn (Order $order) => $order->user_id === $this->id
                || $order->email === $this->username);
    }
}
