<?php

//Get Heroku ClearDB connection information
$cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
$cleardb_server = $cleardb_url["host"];
$cleardb_username = $cleardb_url["user"];
$cleardb_password = $cleardb_url["pass"];
$cleardb_db = substr($cleardb_url["path"], 1);
$active_group = 'default';
$query_builder = TRUE;

$charset = 'utf8mb4';
$dsn = "mysql:host=$cleardb_server;dbname=$cleardb_db;charset=$charset";

/*$host = 'localhost';
$db   = 'apoal';
$charset = 'utf8mb4';
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

if (file_exists(__DIR__ . '/local.php')) {
    include __DIR__ . '/local.php';
}*/

try {
    $pdo = new PDO($dsn, $cleardb_username, $cleardb_password);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
