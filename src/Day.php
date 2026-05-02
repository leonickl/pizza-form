<?php

namespace App;

use PXP\Ds\Vector;

/**
 * Bitmask for weekdays
 * Next day should therefor have 4, next 8, and so on
 */
enum Day: int
{
    case SATURDAY = 1;
    case SUNDAY = 2;

    public function label(): string
    {
        return match ($this) {
            self::SATURDAY => 'Samstag',
            self::SUNDAY => 'Sonntag',
        };
    }

    /**
     * @return Vector<self>
     */
    public static function all(): Vector
    {
        return v(...self::cases());
    }

    /**
     * @param  Vector<self>  $days
     */
    public static function combine(Vector $days): int
    {
        $mask = 0;

        foreach ($days as $day) {
            $mask |= $day->value;
        }

        return $mask;
    }

    /**
     * @return Vector<self>
     */
    public static function separate(int $days): Vector
    {
        return self::all()
            ->filter(fn (self $day) => ($days & $day->value) > 0);
    }
}
