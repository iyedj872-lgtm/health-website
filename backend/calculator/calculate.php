<?php
session_start();
include("../config/db.php");

// Vérifier que l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../pages/login.php");
    exit;
}

if (isset($_POST['height'], $_POST['weight'], $_POST['age'], $_POST['gender'], $_POST['activity'])) {

    $height   = (int) $_POST['height'];
    $weight   = (int) $_POST['weight'];
    $age      = (int) $_POST['age'];
    $gender   = $_POST['gender'];
    $activity = (float) $_POST['activity'];

    // Calcul du BMI
    $bmi = $weight / (($height / 100) * ($height / 100));

    // Catégorie et conseil
    if ($bmi < 18.5) {
        $status = "Underweight";
        $advice = "You should eat more balanced meals and increase calorie intake.";
    } elseif ($bmi < 25) {
        $status = "Normal weight";
        $advice = "Keep maintaining your healthy lifestyle!";
    } elseif ($bmi < 30) {
        $status = "Overweight";
        $advice = "Try exercising more and reducing calorie intake.";
    } else {
        $status = "Obese";
        $advice = "Consider a structured diet and regular physical activity.";
    }

    // Calcul des calories (formule Mifflin-St Jeor)
    $bmr = ($gender == "male")
        ? (10 * $weight + 6.25 * $height - 5 * $age + 5)
        : (10 * $weight + 6.25 * $height - 5 * $age - 161);
    $calories = round($bmr * $activity);

    // Sauvegarde en base de données via PDO
    $stmt = $conn->prepare("INSERT INTO calculator_history 
        (user_id, height, weight, age, gender, activity, bmi, calories, status, advice) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([
        $_SESSION['user_id'],
        $height,
        $weight,
        $age,
        $gender,
        $activity,
        round($bmi, 2),
        $calories,
        $status,
        $advice
    ]);

    // Redirection avec les résultats en paramètres
    header("Location: ../../pages/calculator.php?success=1&bmi=" . round($bmi, 1) . "&status=" . urlencode($status) . "&calories=" . $calories . "&advice=" . urlencode($advice));
    exit;

} else {
    // Si accès direct sans POST, rediriger vers le formulaire
    header("Location: ../../pages/calculator.php");
    exit;
}
?>
