<?php

include("../includes/header.php");
include("../includes/navbar.php");
include_once(__DIR__ . "/../backend/config/db.php");
?>

<div class="container mt-5">
    <h2 class="text-center mb-4">🧮 BMI & Calorie Calculator</h2>

    <?php if(isset($_GET['success'])): ?>
        <div class="alert alert-success text-center">✅ Results saved successfully!</div>
    <?php endif; ?>

    <?php if(isset($_GET['bmi'])): ?>
        <div class="row justify-content-center mb-4">
            <div class="col-md-6">
                <div class="alert alert-info">
                    <p><strong>BMI:</strong> <?= htmlspecialchars($_GET['bmi']) ?></p>
                    <p><strong>Category:</strong> <?= htmlspecialchars($_GET['status']) ?></p>
                    <p><strong>Estimated Calories Needed:</strong> <?= htmlspecialchars($_GET['calories']) ?> kcal/day</p>
                    <p><strong>Advice:</strong> <?= htmlspecialchars(urldecode($_GET['advice'])) ?></p>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card p-4">

                <!-- Calculator Form -->
                <form id="calculatorForm" method="POST" action="../backend/calculator/calculate.php">

                    <div class="mb-3">
                        <label class="form-label">Height (cm)</label>
                        <input type="number" name="height" id="height" class="form-control" placeholder="Enter your height in cm" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Weight (kg)</label>
                        <input type="number" name="weight" id="weight" class="form-control" placeholder="Enter your weight in kg" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Age</label>
                        <input type="number" name="age" id="age" class="form-control" placeholder="Enter your age" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Gender</label>
                        <select name="gender" class="form-control" required>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Activity Level</label>
                        <select name="activity" class="form-control" required>
                            <option value="1.2">Sedentary (little or no exercise)</option>
                            <option value="1.375">Lightly active (1-3 days/week)</option>
                            <option value="1.55">Moderately active (3-5 days/week)</option>
                            <option value="1.725">Very active (6-7 days/week)</option>
                            <option value="1.9">Extra active (physical job)</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Calculate & Save</button>
                </form>

            </div>
        </div>
    </div>
</div>

<script src="../assets/js/calculator.js"></script>

<?php include("../includes/footer.php"); ?>
