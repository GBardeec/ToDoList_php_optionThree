<?php
require_once("database_tasks.php");

if(isset($_POST['deleteOne']) && isset($_POST['taskId'])) {
    $taskId = $_POST['taskId'];

    $sql = "DELETE FROM tasks WHERE id = $taskId";
    if ($connection->query($sql) === TRUE) {
        header("Location: ../../resources/views/index.php");
    } else {
        echo "Ошибка при удалении данных: " . $connection->error;
    }
} else {
    echo "Ошибка при удалении данных";
}

$connection->close();
?>