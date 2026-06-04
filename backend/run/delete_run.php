<?php
session_start();
include("../../config/db.php");

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false]);
    exit;
}

if (isset($_GET['id'])) {
    $id      = $_GET['id'];
    $user_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("DELETE FROM run_tracker WHERE id = ? AND user_id = ?");
    $stmt->execute([$id, $user_id]);

    echo json_encode(['success' => true]);
    exit;
}
?>
