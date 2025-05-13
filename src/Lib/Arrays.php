<?php

namespace App\Lib;

class Arrays
{
    public function __construct(private array $array)
    {
    }

    public function access(string|array|null $key = null)
    {
        if ($key === null) {
            return $this->array;
        }

        if (is_string($key)) {
            return $this->array[$key] ?? null;
        }

        if (is_array($key)) {
            $values = [];

            foreach ($key as $k) {
                $values[$k] = $this->access($k);
            }

            return obj(...$values);
        }

        throw new \RuntimeException("invalid key '$key'");
    }
}