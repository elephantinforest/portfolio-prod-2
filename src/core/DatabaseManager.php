<?php

class DatabaseManager
{
    /** @phpstan-ignore-next-line */
    protected array $models;
    protected mysqli $mysqli;

    public function connect(mixed $params): void
    {
        $mysqli = new mysqli($params['hostname'], $params['username'], $params['password'], $params['database']);

        if($mysqli->connect_error) {
            throw new RuntimeException('mysqli接続エラー: '. $mysqli->connect_error);
        }
        $this->mysqli = $mysqli;
    }

    /** @phpstan-ignore-next-line */
    public function get(string $modelName)
    {
        if (!isset($this->models[$modelName])) {
            $model = new $modelName($this->mysqli);
            $this->models[$modelName] = $model;
        }

        return $this->models[$modelName];
    }

    public function getMysqli()
    {
      return $this->mysqli;
    }

    // public function __destruct()
    // {
    //     $this->mysqli->close();
    // }
}
