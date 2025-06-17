<?php

namespace App\Models;

class Order extends Model
{
    protected $table = 'orders';
    protected $fields = ['id', 'name', 'type', 'extra'];
}
