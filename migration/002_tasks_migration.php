<?php
require_once '000_database.php';

$sql = "CREATE TABLE tasks (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        user_id INT(6) UNSIGNED,
        description TEXT NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        status VARCHAR(20),
        FOREIGN KEY (user_id) REFERENCES users(id)
    )";

if ($connection->query($sql) === TRUE) {
    echo "Таблица 'tasks' успешно создана";
} else {
    echo "Ошибка: " . $connection->error;
}

$connection->close();
