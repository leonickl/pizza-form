<?php

namespace App\Lib;

class DB
{
    private const string DB = __DIR__ . '/../database/db.sqlite';

    private function __construct(private \PDO $pdo) {}

    public static function init()
    {
        try {
            return new self(pdo: new \PDO('sqlite:' . self::DB));
        } catch(\PDOException $e) {
            Log::log($e->getMessage());
        }
    }

    public function pdo()
    {
        return $this->pdo;
    }

    public function create(string $name, array $columns)
    {
        $db_columns = '';

        foreach($columns as $name => $type) {
            $db_columns .= "$name $type";

            if(array_key_last($columns) !== $name) {
                $db_columns .= ', ';
            }
        }

        $sql = "create table if not exists $name ($db_columns);";

        $this->pdo->exec($sql);
    }
}