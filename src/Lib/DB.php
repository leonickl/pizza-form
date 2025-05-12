<?php

namespace App\Lib;

class DB
{
    private const string DB = __DIR__ . '/../../database/db.sqlite';

    private function __construct(private \PDO $pdo)
    {
    }

    public static function init()
    {
        try {
            return new self(pdo: new \PDO('sqlite:' . self::DB));
        } catch (\PDOException $e) {
            Log::log($e->getMessage());

            throw $e;
        }
    }

    public function pdo()
    {
        return $this->pdo;
    }

    public function create(string $table, array $columns)
    {
        $db_columns = '';

        foreach ($columns as $name => $type) {
            $db_columns .= "$name $type";

            if (array_key_last($columns) !== $name) {
                $db_columns .= ', ';
            }
        }

        $sql = "create table if not exists $table ($db_columns);";

        $this->pdo->exec($sql);
    }

    public function all(string $table)
    {
        $stmt = $this->pdo->prepare("select * from $table;");
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function find(string $table, int $id)
    {
        $stmt = $this->pdo->prepare("select * from $table where id = ?;");
        $stmt->execute([$id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function insert(string $table, array $record)
    {
        $columns = c(...$record)
            ->keys()
            ->map(fn($x) => "`$x`")
            ->join(', ');

        $placeholders = Collection::repeat('?', 3)->join(', ');

        $sql = "insert into `$table` ($columns) values ($placeholders);";

        $values = c(...$record)
            ->values()
            ->toArray();

        $status = $this->pdo->prepare($sql)->execute($values);

        if ($status === false) {
            throw new \Exception("creating record failed");
        }

        $id = $this->pdo->lastInsertId();

        return $this->find($table, $id);
    }

    public function update(string $table, array $record)
    {
        $update = '';

        foreach ($record as $key => $value) {
            $update .= "$key = ?";

            if (array_key_last($record) !== $key) {
                $update .= ', ';
            }
        }

        $id = $record['id'];

        $sql = "update `$table` set $update where id = $id;";

        $values = c(...$record)
            ->values()
            ->toArray();

        $status = $this->pdo->prepare($sql)->execute($values);

        if ($status === false) {
            throw new \Exception("creating record failed");
        }

        return $this->find($table, $id);
    }
}