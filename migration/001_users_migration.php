<?php
$connection = require_once '000_database.php';

$sql = "CREATE TABLE users (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        login VARCHAR(30) NOT NULL,
        password VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";

if ($connection->query($sql) === TRUE) {
    echo "Таблица 'user' успешно создана ";
} else {
    echo "Ошибка: " . $connection->error;
}

$connection->close();
