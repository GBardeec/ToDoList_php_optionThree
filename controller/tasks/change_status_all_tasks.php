<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . "/migration/000_database.php");

try {
    $sql = "UPDATE tasks SET status = 'unready' WHERE status IS NULL AND user_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$_SESSION['id']]);
    header("Location: ../../index.php");
} catch (PDOException $e) {
    echo "Ошибка при обновлении данных: " . $e->getMessage();
}