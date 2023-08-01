<?php
require_once("database_tasks.php");
$queryStatusNull = "SELECT description,status FROM tasks WHERE status IS NULL AND user_id = '{$_SESSION['id']}'";
$resultStatusNull  = mysqli_query($connection, $queryStatusNull);

$queryStatusNotNull = "SELECT id,description,status FROM tasks WHERE status IS NOT NULL AND user_id = '{$_SESSION['id']}'";
$resultStatusNotNull  = mysqli_query($connection, $queryStatusNotNull);

$connection->close();
?>