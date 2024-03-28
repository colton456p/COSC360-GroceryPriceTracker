<?php
$host = 'localhost';
$db = 'db_38885190';
$user = '38885190';
$pass = '38885190';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

// Create connection
$db1 = new mysqli($host, $user, $pass, $db);

// Check connection
if ($db1->connect_error) {
    die("Connection failed: " . $db1->connect_error);
}



