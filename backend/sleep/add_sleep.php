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

    $user_id = $_SESSION['user_id'];
    $date    = $_POST['date']    ?? '';
    $hours   = $_POST['hours']   ?? 0;
    $quality = $_POST['quality'] ?? '';
    $notes   = $_POST['notes']   ?? '';

    if (empty($date) || $hours <= 0) {
        echo json_encode(['success' => false, 'message' => 'Invalid data received']);
        exit;
    }

    if ($hours < 6) {
        $advice = "You need more sleep 😴";
    } elseif ($hours <= 8) {
        $advice = "Good sleep ✅";
    } else {
        $advice = "Oversleeping, try to balance ⏰";
    }

    try {
        $stmt = $conn->prepare("INSERT INTO sleep_tracker (user_id, date, hours, quality, notes, advice) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$user_id, $date, $hours, $quality, $notes, $advice]);
        echo json_encode(['success' => true, 'advice' => $advice]);
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'DB Error: ' . $e->getMessage()]);
    }

} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>
