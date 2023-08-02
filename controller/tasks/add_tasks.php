<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . "/migration/000_database.php");

$user_id = (integer) $_SESSION['id'];
$description = $_POST['description'];
$created_at = date('Y-m-d H:i:s');

try {
    $sql= "INSERT INTO tasks (user_id, description, created_at) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$user_id, $description, $created_at]);
    header("Location: ../../index.php");
} catch (PDOException $e) {
    echo "Ошибка: " . $e->getMessage();
}