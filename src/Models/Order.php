<?php

namespace App\Models;

use App\Day;
use PXP\Data\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $email
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
}
