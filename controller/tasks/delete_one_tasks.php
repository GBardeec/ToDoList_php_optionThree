<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/migration/000_database.php");

if(isset($_POST['deleteOne']) && isset($_POST['taskId'])) {
    $taskId = $_POST['taskId'];

    try {
        $sql = "DELETE FROM tasks WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$taskId]);
        header("Location: ../../index.php");
    } catch (PDOException $e) {
        echo "Ошибка при удалении данных: " . $e->getMessage();
    }
} else {
    echo "Ошибка при удалении данных";
}