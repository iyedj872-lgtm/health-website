<?php
// Activer l'affichage des erreurs pour debug
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

// Vérifier que la session existe
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Not logged in - session expired']);
    exit;
}

// Vérifier que db.php existe
$db_path = __DIR__ . "/../config/db.php";
if (!file_exists($db_path)) {
    echo json_encode(['success' => false, 'message' => 'db.php not found at: ' . $db_path]);
    exit;
}

include($db_path);

// Vérifier que $conn existe
if (!isset($conn)) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $user_id  = $_SESSION['user_id'];
    $date     = $_POST['date']     ?? '';
    $distance = $_POST['distance'] ?? 0;
    $time     = $_POST['time']     ?? 0;
    $company  = $_POST['company']  ?? 'Alone';
    $notes    = $_POST['notes']    ?? '';

    if (empty($date) || $distance <= 0 || $time <= 0) {
        echo json_encode(['success' => false, 'message' => 'Invalid data received']);
        exit;
    }

    $pace = round($time / $distance, 2);

    try {
        $stmt = $conn->prepare("INSERT INTO run_tracker (user_id, date, distance, time, pace, company, notes) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$user_id, $date, $distance, $time, $pace, $company, $notes]);
        echo json_encode(['success' => true, 'pace' => $pace]);
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'DB Error: ' . $e->getMessage()]);
    }

} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>
