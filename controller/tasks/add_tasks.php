<?php
require_once("database_tasks.php");
session_start();

$user_id = (integer) $_SESSION['id'];
$description = htmlspecialchars($_POST['description']);
$created_at = date('Y-m-d H:i:s');

$sql= "INSERT INTO tasks (user_id, description, created_at) VALUES ('$user_id', '$description', '$created_at')";

if($connection->query($sql)){
    header("Location: ../../resources/views/index.php");
}else{
    echo "Ошибка";
}
?>