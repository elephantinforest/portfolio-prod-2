<?php
require_once '/var/www/html/src/migration/tablequery.php';
// データベースへの接続
$mysqli = new mysqli('db', 'test_user', 'pass', 'test_database');
if ($mysqli->connect_error) {
  throw new RuntimeException('mysqli接続エラー: ' . $mysqli->connect_error);
}
// テーブルを作成する関数の呼び出し
createTables($mysqli);

// データベース接続を閉じる
$mysqli->close();


// テーブルを作成する関数
