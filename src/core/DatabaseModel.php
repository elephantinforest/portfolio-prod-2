<?php


class DatabaseModel
{
    protected Mysqli $mysqli;

    public function __construct(Mysqli $mysqli)
    {
        $this->mysqli = $mysqli;
    }


    /** @phpstan-ignore-next-line */
    public function execute(string $sql, array $params = []): void
    {
        try {
            if ($params) {
                $stmt = $this->mysqli->prepare($sql);
                $stmt->bind_param(...$params);
                $stmt->execute();
                $stmt->close();
            }
        } catch (mysqli_sql_exception $e) {
            // データベース接続に関するエラーの場合
            // ブラウザにエラーメッセージを表示する
            throw new PDOException($e->getMessage());
        }
    }
    /** @phpstan-ignore-next-line */
    public function fetch(string $sql, array $params = [])
    {
        if ($params) {
            try {
                $stmt = $this->mysqli->prepare($sql);
                $stmt->bind_param(...$params);
                $stmt->execute();
                $result = $stmt->get_result();
                /* 値を取得します */
                $results = $result->fetch_all(MYSQLI_ASSOC);
                $stmt->close();
                return $results;
            } catch (mysqli_sql_exception $e) {
                throw new PDOException($e->getMessage());
            }
        }
    }
    public function getInsertId() {
        try {
            $result = $this->mysqli->query(' SELECT LAST_INSERT_ID()');

            if (!$result) {
                throw new mysqli_sql_exception($this->mysqli->error);
            }
            $insertId =  $result->fetch_all(MYSQLI_ASSOC);
            return $insertId[0]['LAST_INSERT_ID()'];
            $result->free_result();
        } catch (mysqli_sql_exception $e) {
            throw new PDOException($e->getMessage());
        }
    }
}
