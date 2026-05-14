<?php

namespace App\Models;

use App\Day;
use PXP\Data\Model;
use PXP\Ds\Vector;

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
 * @property string|null $archived_at
 */
class Order extends Model
{
    protected string $table = 'orders';

    /**
     * @return Vector<static>
     */
    public static function all(): Vector
    {
        return parent::all()
            ->filter(fn (self $order) => $order->archived_at === null);
    }

    /**
     * @return Vector<static>
     */
    public static function archived(): Vector
    {
        return parent::all()
            ->filter(fn (self $order) => $order->archived_at !== null);
    }

    public function archive(): self
    {
        $this->archived_at = date('Y-m-d H:i:s');
        $this->save();

        return $this;
    }

    public function unarchive(): self
    {
        $this->archived_at = null;
        $this->save();

        return $this;
    }

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
