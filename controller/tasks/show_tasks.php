<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/migration/000_database.php");

function getTasksWithStatusNull($pdo, $userId) {
    $queryStatusNull = "SELECT description,status FROM tasks WHERE status IS NULL AND user_id = :user_id";
    $stmtStatusNull = $pdo->prepare($queryStatusNull);
    $stmtStatusNull->bindParam(':user_id', $userId);
    $stmtStatusNull->execute();
    $resultStatusNull = $stmtStatusNull->fetchAll(PDO::FETCH_ASSOC);

    return $resultStatusNull;
}

function getTasksWithStatusNotNull($pdo, $userId) {
    $queryStatusNotNull = "SELECT id,description,status FROM tasks WHERE status IS NOT NULL AND user_id = :user_id";
    $stmtStatusNotNull = $pdo->prepare($queryStatusNotNull);
    $stmtStatusNotNull->bindParam(':user_id', $userId);
    $stmtStatusNotNull->execute();
    $resultStatusNotNull = $stmtStatusNotNull->fetchAll(PDO::FETCH_ASSOC);

    return $resultStatusNotNull;
}
?>