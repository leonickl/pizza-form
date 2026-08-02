<?php

namespace App\Models;

use PXP\Auth\Models\User as BaseUser;
use PXP\Ds\Vector;

class User extends BaseUser
{
    /**
     * @return Vector<Order>
     */
    public function orders(): Vector
    {
        return Order::all()
            ->with(...Order::archived())
            ->sort(fn ($one, $other) => $one->id <=> $other->id)
            ->filter(fn (Order $order) => $order->user_id === $this->id
                || $order->email === $this->email);
    }
}
