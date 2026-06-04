<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once(__DIR__ . "/../config/db.php");

if (!isset($_SESSION['user_id'])) {
    $user = null;
} else {
    $user_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("SELECT id, name, email FROM users WHERE id = :id");
    $stmt->bindParam(":id", $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $user = $stmt->fetch();
}
?>