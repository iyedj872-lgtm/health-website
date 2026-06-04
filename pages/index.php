<?php
include("../includes/header.php");
include("../includes/navbar.php");
include_once(__DIR__ . "/../backend/config/db.php");
?>

<!-- Hero Section -->
<div class="container hero mt-5">
    <h1>Welcome to Your Health Tracker 🏋️‍♂️🍎🏃‍♀️</h1>
    <p>Track your workouts, sleep, nutrition, and runs all in one place!</p>
    <img src="../assets/images/health-hero.jpg" alt="Healthy lifestyle illustration">
</div>

<!-- Features Section -->
<div class="container mt-5">
    <div class="row">

        <div class="col-md-4 mb-3">
            <div class="card p-3 text-center">
                <h3>Calculator</h3>
                <p>Check your BMI and daily calorie needs instantly.</p>
                <a href="calculator.php" class="btn btn-primary w-100">Go to Calculator</a>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card p-3 text-center">
                <h3>Run Tracker</h3>
                <p>Record your runs, pace, and set future goals.</p>
                <a href="run_tracker.php" class="btn btn-success w-100">Go to Run Tracker</a>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card p-3 text-center">
                <h3>Sleep Tracker</h3>
                <p>Monitor your sleep patterns and recovery.</p>
                <a href="sleep_tracker.php" class="btn btn-warning w-100">Go to Sleep Tracker</a>
            </div>
        </div>

        <div class="col-md-6 mb-3">
            <div class="card p-3 text-center">
                <h3>Nutrition & Water</h3>
                <p>Track meals, calories, and hydration daily.</p>
                <a href="nutrition.php" class="btn btn-info w-100">Go to Nutrition</a>
            </div>
        </div>

        <div class="col-md-6 mb-3">
            <div class="card p-3 text-center">
                <h3>Profile & Settings</h3>
                <p>Manage your profile, password, and preferences.</p>
                <a href="profile.php" class="btn btn-secondary w-100">Go to Profile</a>
            </div>
        </div>

    </div>
</div>

<!-- JS -->
<script src="../js/main.js"></script> <!-- Global JS for navbar, alerts, scrolling -->

<?php
include("../includes/footer.php");
?>