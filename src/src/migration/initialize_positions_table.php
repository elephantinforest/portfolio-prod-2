<?php

$mysqli = new mysqli('db', 'test_user', 'pass', 'test_database');
if ($mysqli->connect_error) {
    throw new RuntimeException('mysqli接続エラー: ' . $mysqli->connect_error);
}

$mysqli->query('DROP TABLE IF EXISTS positions');

$createTableSql = <<<EOL
CREATE TABLE IF NOT EXISTS positions (
    position_id INT PRIMARY KEY AUTO_INCREMENT,
    register_id INT NOT NULL,
    left_position DOUBLE NOT NULL,
    top_position DOUBLE NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=INNODB DEFAULT CHARSET=utf8mb4;
EOL;

if ($mysqli->query($createTableSql) === true) {
    echo "テーブルが正常に作成されました\n";
} else {
    echo "エラー: " . $mysqli->error . "\n";
}

$mysqli->close();
