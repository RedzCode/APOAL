<?php

$host = 'localhost';
$db   = 'apoal';
$charset = 'utf8mb4';
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

if (file_exists(__DIR__ . '/local.php')) {
    include __DIR__ . '/local.php';
  }

try {
    $pdo = new PDO($dsn, $user, $pass); 
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}