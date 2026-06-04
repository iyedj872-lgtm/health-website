<?php include("../includes/header.php"); ?>
<?php include("../includes/navbar.php"); ?>
<?php
include_once(__DIR__ . "/../backend/config/db.php");
?>

<div class="container mt-5">

    <h2 class="text-center mb-4">🏋️ Gym Exercises</h2>

    <!-- CHEST -->
    <h3 class="mt-4">Chest</h3>
    <div class="row">

        <div class="col-md-4">
            <div class="card p-3">
                <img src="../images/pushup.png" class="img-fluid mb-2">
                <h5>Push-ups</h5>
                <p>Great bodyweight exercise for chest and triceps.</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-3">
                <img src="../images/benchpress.png" class="img-fluid mb-2">
                <h5>Bench Press</h5>
                <p>Classic exercise to build chest strength.</p>
            </div>
        </div>

    </div>

    <!-- BACK -->
    <h3 class="mt-4">Back</h3>
    <div class="row">

        <div class="col-md-4">
            <div class="card p-3">
                <img src="../images/pullup.png" class="img-fluid mb-2">
                <h5>Pull-ups</h5>
                <p>Excellent for building back and arms.</p>
            </div>
        </div>

    </div>

    <!-- LEGS -->
    <h3 class="mt-4">Legs</h3>
    <div class="row">

        <div class="col-md-4">
            <div class="card p-3">
                <img src="../images/squat.png" class="img-fluid mb-2">
                <h5>Squats</h5>
                <p>Best exercise for legs and glutes.</p>
            </div>
        </div>

    </div>

    <!-- ARMS -->
    <h3 class="mt-4">Arms</h3>
    <div class="row">

        <div class="col-md-4">
            <div class="card p-3">
                <img src="../images/biceps.png" class="img-fluid mb-2">
                <h5>Bicep Curls</h5>
                <p>Targets the biceps effectively.</p>
            </div>
        </div>

    </div>

    <!-- SHOULDERS -->
    <h3 class="mt-4">Shoulders</h3>
    <div class="row">

        <div class="col-md-4">
            <div class="card p-3">
                <img src="../images/shoulderpress.png" class="img-fluid mb-2">
                <h5>Shoulder Press</h5>
                <p>Builds strong and defined shoulders.</p>
            </div>
        </div>

    </div>

</div>

<?php include("../includes/footer.php"); ?>