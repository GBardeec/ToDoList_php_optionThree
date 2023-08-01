<?php
require_once("database_tasks.php");

if(isset($_POST['toggleStatus'])) {
    $taskId = $_POST['taskId'];

    $sql = "SELECT status FROM tasks WHERE id = '$taskId'";
    $result = $connection->query($sql);
    $row = mysqli_fetch_assoc($result);
    $currentStatus = $row['status'];

    if ($currentStatus == 'unready') {
        $newStatus = 'ready';
    } else {
        $newStatus = 'unready';
    }

    $sql = "UPDATE tasks SET status = '$newStatus' WHERE id = '$taskId'";
    if ($connection->query($sql) === TRUE) {
        header("Location: ../../resources/views/index.php");
    } else {
        echo "Ошибка при обновлении данных: " . $connection->error;
    }
}

$connection->close();
?>
