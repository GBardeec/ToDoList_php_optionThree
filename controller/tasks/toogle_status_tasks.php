<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . "/migration/000_database.php");

if(isset($_POST['toggleStatus'])) {
    $taskId = $_POST['taskId'];

    try {
        $sql = "SELECT status FROM tasks WHERE id = ? AND user_id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$taskId, $_SESSION['id']]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $currentStatus = $row['status'];

        if ($currentStatus == 'unready') {
            $newStatus = 'ready';
        } else {
            $newStatus = 'unready';
        }

        $sql = "UPDATE tasks SET status = ? WHERE id = ? AND user_id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$newStatus, $taskId, $_SESSION['id']]);
        header("Location: /index.php");
    } catch (PDOException $e) {
        echo "Ошибка при обновлении данных: " . $e->getMessage();
    }
}