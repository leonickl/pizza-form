<?php

namespace App\Models;

use App\Enums\Role;
use App\Mail;
use PXP\Data\Model;
use PXP\Ds\Vector;

/**
 * @property int $id
 * @property string $name
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

    /**
     * @return Vector<Order>
     */
    public function orders(): Vector
    {
        return Order::all()
            ->filter(fn (Order $order) => $order->user_id === $this->id
                || $order->email === $this->username);
    }

    public function sendVerification(): void
    {
        $link = VerificationLink::create(user_id: $this->id)->url();

        new Mail(
            subject: 'E-Mail-Adresse verifizieren',
            body: "Klicke bitte auf den folgenden Link, um deine E-Mail-Adresse zu verifizieren: <a href=\"$link\">$link</a>",
            html: true,
        )
            ->send($this->username, $this->name);
    }
}
