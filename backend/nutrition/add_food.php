<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Not logged in - session expired']);
    exit;
}

$db_path = __DIR__ . "/../config/db.php";
if (!file_exists($db_path)) {
    echo json_encode(['success' => false, 'message' => 'db.php not found at: ' . $db_path]);
    exit;
}

include($db_path);

if (!isset($conn)) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $user_id   = $_SESSION['user_id'];
    $meal_name = $_POST['meal_name'] ?? '';
    $calories  = $_POST['calories']  ?? 0;
    $water     = $_POST['water']     ?? 0;
    $notes     = $_POST['notes']     ?? '';

    if (empty($meal_name) || $calories <= 0) {
        echo json_encode(['success' => false, 'message' => 'Invalid data received']);
        exit;
    }

    try {
        $stmt = $conn->prepare("INSERT INTO nutrition_tracker (user_id, meal_name, calories, water, notes) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$user_id, $meal_name, $calories, $water, $notes]);
        echo json_encode(['success' => true]);
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'DB Error: ' . $e->getMessage()]);
    }

} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>
