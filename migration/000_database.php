<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "tasklist";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$database;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Подключение не произошло: " . $e->getMessage());
}

return $pdo;
