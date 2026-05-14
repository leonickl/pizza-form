<?php

namespace App;

readonly class Notification
{
    private function __construct(public string $type, public string $content) {}

    private static function make(string $type, string $content): self
    {
        $notifications = session()->array('notifications');

        session([
            'notifications' => [...$notifications, new self($type, $content)],
        ]);

        return $new;
    }

    public static function info(string $content): self
    {
        return self::make('info', $content);
    }

    public static function success(string $content): self
    {
        return self::make('success', $content);
    }

    public static function warning(string $content): self
    {
        return self::make('warning', $content);
    }
}
