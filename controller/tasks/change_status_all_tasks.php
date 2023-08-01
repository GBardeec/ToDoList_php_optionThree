<?php
require_once("database_tasks.php");

$sql = "UPDATE tasks SET status = 'unready' WHERE status IS NULL";

if ($connection->query($sql) === TRUE) {
    header("Location: ../../resources/views/index.php");
} else {
    echo "Ошибка при обновлении данных: " . $connection->error;
}

$connection->close();
?>
