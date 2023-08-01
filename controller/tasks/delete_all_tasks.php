<?php
require_once("database_tasks.php");

$sql = "DELETE FROM tasks WHERE status IS NULL";

if ($connection->query($sql) === TRUE) {
    header("Location: ../../resources/views/index.php");
} else {
    echo "Ошибка при удалении данных: " . $connection->error;
}

$connection->close();
?>
