<?php

namespace App\Controllers;

use App\Day;
use App\Models\Order;
use PXP\Core\Lib\Router;
use PXP\Core\Lib\Session;
use PXP\Core\Exceptions\ValidationException;

class OrderController
{
    public function index()
    {
        if (! perma('accessible', false)) {
            return view('orders-closed');
        }

        return view('main', [
            'order' => Session::take('order'),
        ]);
    }

    public function action()
    {
        $data = request(['name', 'email', 'type', 'extra', 'days']);

        if ($data->name === null || ! is_string($data->name) || strlen($data->name) < 3 || strlen($data->name) > 40) {
            throw new ValidationException('name is required and must be between 3 and 40 characters long');
        }

        if ($data->email === null || ! is_string($data->email) || strlen($data->email) < 6 || strlen($data->email) > 50) {
            throw new ValidationException('email is required and must be between 6 and 50 characters long');
        }

        if ($data->type === null || ! is_string($data->type) || ! in_array($data->type, ['Vegan', 'Vegetarisch', 'Alles'])) {
            throw new ValidationException('type is required and must be a valid entry from the list');
        }

        if ($data->extra !== null && (! is_string($data->extra) || strlen($data->extra) > 300)) {
            throw new ValidationException('extra must be maximum 300 characters long if given');
        }

        if ($data->days !== null && ! is_array($data->days)) {
            throw new ValidationException('days must be an array if given');
        }

        $data->days = Day::combine(
            c(...$data->days ?? [])
                ->map(fn ($day) => Day::from((int) $day)),
        );

        return Router::redirect('/', [
            'order' => Order::create(...(array) $data, paid: false),
        ]);
    }
}
