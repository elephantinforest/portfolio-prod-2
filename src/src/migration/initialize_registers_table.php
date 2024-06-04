<?php

$mysqli = new mysqli('db', 'test_user', 'pass', 'test_database');
if ($mysqli->connect_error) {
    throw new RuntimeException('mysqli接続エラー: ' . $mysqli->connect_error);
}

$mysqli->query('DROP TABLE IF EXISTS registers');

$createTableSql = <<<EOL
CREATE TABLE IF NOT EXISTS registers (
    register_id INT  AUTO_INCREMENT,
    user_id INT NOT NULL,
    location_id INT  DEFAULT 0,
    name VARCHAR(255) NOT NULL,
    genre VARCHAR(255) NOT NULL,
    price INT NOT NULL,
    other TEXT ,
    file_name VARCHAR(255) NOT NULL,
    file_path VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (register_id, user_id,location_id)
) ENGINE=INNODB DEFAULT CHARSET=utf8mb4
EOL;

if ($mysqli->query($createTableSql) === true) {
    echo "テーブルが正常に作成されました\n";
} else {
    echo "エラー: " . $mysqli->error . "\n";
}

$mysqli->close();
