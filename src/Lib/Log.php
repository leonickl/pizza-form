<?php

namespace App\Lib;

class Log
{
    private const string LOG = __DIR__ . '/../log/';

    private static function file()
    {
        return self::LOG . date('Y-m-d') . '.log';
    }

    public static function log(string $data)
    {
        file_put_contents(self::file(), PHP_EOL . date('Y-m-d H:i:s') . ': ' . $data, FILE_APPEND);
    }
}