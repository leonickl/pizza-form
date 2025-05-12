<?php

namespace App\Lib;


class Collection implements \ArrayAccess, \Countable
{
    private function __construct(private array $items)
    {
    }

    public static function make(array $items = []): self
    {
        return new self($items);
    }

    public static function repeat(mixed $value, int $times)
    {
        $array = [];

        for ($i = 0; $i < $times; $i++) {
            $array[] = $value;
        }

        return self::make($array);
    }

    public function offsetExists(mixed $offset): bool
    {
        return isset($this->items[$offset]);
    }

    public function offsetGet(mixed $offset): mixed
    {
        return $this->items[$offset];
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        $this->items[$offset] = $value;
    }

    public function offsetUnset(mixed $offset): void
    {
        unset($this->items[$offset]);
    }

    public function count(): int
    {
        return count($this->items);
    }

    public function map(callable $callback)
    {
        return self::make(array_map($callback, $this->items));
    }

    public function filter(callable $callback)
    {
        return self::make(array_filter($this->items, $callback));
    }

    public function join(string $glue = '')
    {
        return implode($glue, $this->items);
    }

    public function last()
    {
        return $this->items[count($this->items) - 1];
    }

    public function dd(mixed ...$append)
    {
        dd($this->items, ...$append);
    }

    public function keys()
    {
        return self::make(array_keys($this->items));
    }

    public function values()
    {
        return self::make(array_values($this->items));
    }

    public function toArray()
    {
        return $this->items;
    }
}