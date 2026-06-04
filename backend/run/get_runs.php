<?php
session_start();
include("../config/db.php");
 
if (!isset($_SESSION['user_id'])) {
    echo json_encode([]);
    exit;
}
 
$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT * FROM run_tracker WHERE user_id = ? ORDER BY date DESC");
$stmt->execute([$user_id]);
$runs = $stmt->fetchAll();
 
header('Content-Type: application/json');
echo json_encode($runs);
?>