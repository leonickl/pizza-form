<?php

namespace App\Models;

use App\Day;
use PXP\Data\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property int|null $user_id
 * @property string $type
 * @property string|null $extra
 * @property bool $paid
 * @property int $days
 * @property string|null $deleted_at
 */
class Order extends Model
{
    protected string $table = 'orders';

    public function daysLabel(): string
    {
        return Day::separate($this->days)
            ->map(fn ($day) => $day->label())
            ->join(', ');
    }

    /**
     * Fill out name and email by default
     * if a user record is linked.
     */
    public function __get(string $property): mixed
    {
        if ($property === 'name' && $this->user_id !== null) {
            return User::find($this->user_id)->name;
        }

        if ($property === 'email' && $this->user_id !== null) {
            return User::find($this->user_id)->username;
        }

        return parent::__get($property);
    }
}
