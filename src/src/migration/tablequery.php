<?php
// テーブルを作成する関数の定義
function createTable($mysqli, $tableName, $createQuery)
{
  $mysqli->query("DROP TABLE IF EXISTS $tableName");

  if ($mysqli->query($createQuery) === true) {
    echo "テーブル $tableName が正常に作成されました\n";
  } else {
    echo "エラー: " . $mysqli->error . "\n";
  }
}


function createTables($mysqli)
{
  // テーブルの作成
  createTable(
    $mysqli,
    'locations',
    <<<EOL
CREATE TABLE IF NOT EXISTS locations (
    location_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    location VARCHAR(100) NOT NULL,
    file_name VARCHAR(255) NOT NULL,
    file_path VARCHAR(255) NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=INNODB DEFAULT CHARSET=utf8mb4
EOL
  );

  createTable(
    $mysqli,
    'positions',
    <<<EOL
CREATE TABLE IF NOT EXISTS positions (
    position_id INT AUTO_INCREMENT PRIMARY KEY,
    register_id INT NOT NULL,
    left_position DOUBLE NOT NULL,
    top_position DOUBLE NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=INNODB DEFAULT CHARSET=utf8mb4
EOL
  );

  createTable(
    $mysqli,
    'registers',
    <<<EOL
CREATE TABLE IF NOT EXISTS registers (
    register_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    location_id INT DEFAULT 0,
    name VARCHAR(255) NOT NULL,
    genre VARCHAR(255) NOT NULL,
    price INT NOT NULL,
    other TEXT,
    file_name VARCHAR(255) NOT NULL,
    file_path VARCHAR(255) NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=INNODB DEFAULT CHARSET=utf8mb4
EOL
  );

  createTable(
    $mysqli,
    'resizes',
    <<<EOL
CREATE TABLE IF NOT EXISTS resizes (
    register_id INT NOT NULL,
    width INT NOT NULL,
    height INT NOT NULL,
    window_width INT NOT NULL,
    window_height INT NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=INNODB DEFAULT CHARSET=utf8mb4
EOL
  );

  createTable(
    $mysqli,
    'users',
    <<<EOL
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=INNODB DEFAULT CHARSET=utf8mb4
EOL
  );
}
