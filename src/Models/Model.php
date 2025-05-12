<?php

namespace App\Models;

use RuntimeException;

abstract class Model
{
    private array $record = [];

    public function __get(string $attr)
    {
        return @$this->record[$attr];
    }

    public function __set(string $attr, mixed $value)
    {
        $this->record[$attr] = $value;
    }

    public function fill(array $data)
    {
        foreach ($data as $key => $value) {
            $this->record[$key] = $value;
        }
    }

    public function table()
    {
        if (!isset($this->table)) {
            $class = static::class;
            throw new RuntimeException("please set table property for $class");
        }

        return $this->table;
    }

    public static function all()
    {
        $list = \App\Lib\DB::init()->all((new static)->table());

        return c(...$list);
    }

    public static function find(int $id)
    {
        $object = new static;

        $record = \App\Lib\DB::init()->find($object->table(), $id);

        $object->fill($record);

        return $object;
    }

    public function save()
    {
        $updated = $this->id
            ? \App\Lib\DB::init()->update($this->table(), $this->record)
            : \App\Lib\DB::init()->insert($this->table(), $this->record);

        $this->fill($updated);
    }

    public function dd()
    {
        dd($this->record);
    }
}
