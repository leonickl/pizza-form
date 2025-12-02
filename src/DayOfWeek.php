<?php

namespace App;

use PXP\Core\Lib\Collection;

/**
 * Bitmask for weekdays
 * Next day should therefor have 4, next 8, and so on
 */
enum DayOfWeek: int
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

    public static function all(): Collection
    {
        return c(...self::cases());
    }

    public static function combine(Collection $days): int
    {
        $mask = 0;

        foreach ($days as $day) {
            $mask |= $day->value;
        }

        return $mask;
    }

    public static function separate(int $days): Collection
    {
        return self::all()
            ->filter(fn (self $day) => $days & $day->value);
    }
}
