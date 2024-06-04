<?php

$mysqli = new mysqli('db', 'test_user', 'pass', 'test_database');
if ($mysqli->connect_error) {
    throw new RuntimeException('mysqli接続エラー: ' . $mysqli->connect_error);
}

$mysqli->query('DROP TABLE IF EXISTS locations');

$createTableSql = <<<EOL
CREATE TABLE IF NOT EXISTS locations (
    location_id INT  AUTO_INCREMENT,
    user_id int NOT NULL,
    location VARCHAR(100) NOT NULL,
    file_name VARCHAR(255) NOT NULL,
    file_path VARCHAR(255) NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (location_id, user_id)
) ENGINE=INNODB DEFAULT CHARSET=utf8mb4
EOL;

if ($mysqli->query($createTableSql) === true) {
    echo "テーブルが正常に作成されました\n";
} else {
    echo "エラー: " . $mysqli->error . "\n";
}

$mysqli->close();
