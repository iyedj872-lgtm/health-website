<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

if (!isset($_SESSION['user_id'])) {
    echo json_encode([]);
    exit;
}

$db_path = __DIR__ . "/../config/db.php";
if (!file_exists($db_path)) {
    echo json_encode([]);
    exit;
}

include($db_path);

$user_id = $_SESSION['user_id'];

try {
    $stmt = $conn->prepare("SELECT * FROM sleep_tracker WHERE user_id = ? ORDER BY date DESC");
    $stmt->execute([$user_id]);
    $records = $stmt->fetchAll();
    header('Content-Type: application/json');
    echo json_encode($records);
} catch (PDOException $e) {
    echo json_encode([]);
}
?>
