<?php

require '../bootstrap.php';
require '../Application.php';
// require '../vendor/autoload.php';
$db = [
  'hostname' => getenv('MYSQL_HOST'),
  'username' => getenv('MYSQL_USER'),
  'password' => getenv('MYSQL_PASSWORD'),
  'database' => getenv('MYSQL_DATABASE'),
];
$app = new Application($db);
$app->run();
