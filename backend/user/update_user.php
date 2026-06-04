<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once(__DIR__ . "/../config/db.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: ../../pages/login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];

    // Update user in DB
    $stmt = $conn->prepare("UPDATE users SET name = :name, email = :email WHERE id = :id");
    $stmt->bindParam(":name", $name);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":id", $user_id, PDO::PARAM_INT);
    $stmt->execute();

    // Update session variables
    $_SESSION['user_name'] = $name;
    $_SESSION['user_email'] = $email;

    header("Location: ../../pages/profile.php");
    exit;
}
?>