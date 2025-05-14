<?php

namespace App\Models;

use RuntimeException;

abstract class Model
{
    private array $record = [];

    private function __construct(private bool $exists = false)
    {

    }

    public function __get(string $attr)
    {
        return @$this->record[$attr];
    }

    public function __set(string $attr, mixed $value)
    {
        $this->record[$attr] = $value;
    }

    private function fill(array $data)
    {
        foreach ($data as $key => $value) {
            $this->record[$key] = $value;
        }

        return $this;
    }

    private static function table()
    {
        $object = new static;

        if (!isset($object->table)) {
            $class = static::class;
            throw new RuntimeException("please set table property for $class");
        }

        return $object->table;
    }

    public static function all()
    {
        $list = \App\Lib\DB::init()->all(self::table());

        return c(...$list)->map(fn(array $record) => (new static(true))->fill($record));
    }

    public static function find(int $id)
    {
        $object = new static(true);

        $record = \App\Lib\DB::init()->find(self::table(), $id);

        if (!$record) {
            throw new \App\Exceptions\ModelNotFoundException(static::class, $id);
        }

        $object->fill($record);

        return $object;
    }

    public static function new(mixed ...$props)
    {
        return (new static)->fill($props);
    }

    public static function create(mixed ...$props)
    {
        return self::new(...$props)->save();
    }

    public function save()
    {
        $updated = $this->exists
            ? \App\Lib\DB::init()->update(self::table(), $this->record)
            : \App\Lib\DB::init()->insert(self::table(), $this->record);

        $this->fill($updated);

        $this->exists = true;

        return $this;
    }

    public function delete()
    {
        \App\Lib\DB::init()->delete(self::table(), $this->id);
    }

    public function dd()
    {
        dd($this->record);
    }

    public function dump()
    {
        dump($this->record);
        return $this;
    }
}
