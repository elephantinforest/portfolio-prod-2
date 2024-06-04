<?php

$mysqli = new mysqli('db', 'test_user', 'pass', 'test_database');
if ($mysqli->connect_error) {
    throw new RuntimeException('mysqli接続エラー: ' . $mysqli->connect_error);
}

$mysqli->query('DROP TABLE IF EXISTS users');

$createTableSql = <<<EOL
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=INNODB DEFAULT CHARSET=utf8mb4
EOL;

if ($mysqli->query($createTableSql) === true) {
    echo "テーブルが正常に作成されました\n";
} else {
    echo "エラー: " . $mysqli->error . "\n";
}

$mysqli->close();
