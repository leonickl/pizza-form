<?php

namespace App\Models;

use PXP\Core\Lib\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fields = ['id', 'name', 'email', 'type', 'extra', 'paid'];
}
