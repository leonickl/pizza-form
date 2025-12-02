<?php

namespace App\Models;

use App\DayOfWeek;
use PXP\Core\Lib\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fields = ['id', 'name', 'email', 'type', 'extra', 'paid', 'days'];

    public function daysLabel()
    {
        return DayOfWeek::separate($this->days)
            ->map(fn ($day) => $day->label())
            ->join(', ');
    }
}
