<?php
include("../includes/header.php");
include("../includes/navbar.php");
?>
 
<div class="container mt-5">
    <h2 class="text-center mb-4">🍎 Nutrition & Water Tracker</h2>
 
    <div id="nutritionAlert"></div>
 
    <div class="row justify-content-center">
        <div class="col-md-6">
 
            <div class="card p-4">
                <form id="nutritionForm">
                    <div class="mb-2">
                        <label class="form-label">Meal / Drink</label>
                        <input type="text" id="mealName" name="meal_name" class="form-control" placeholder="Meal or Drink" required>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Calories (kcal)</label>
                        <input type="number" id="mealCalories" name="calories" class="form-control" placeholder="Calories" required>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Water Intake (L)</label>
                        <input type="number" step="0.1" id="waterIntake" name="water" class="form-control" placeholder="Liters of water" required>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Notes</label>
                        <textarea id="nutritionNotes" name="notes" class="form-control" rows="2"></textarea>
                    </div>
                    <button type="submit" class="btn btn-success w-100">Add Entry</button>
                </form>
            </div>
 
            <div class="mt-4">
                <div id="totalCalories" class="mb-2 fw-bold">Total Calories: 0 kcal</div>
                <div id="totalWater" class="mb-2 fw-bold">Total Water: 0 L</div>
 
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Meal / Drink</th>
                            <th>Calories</th>
                            <th>Water Intake</th>
                            <th>Notes</th>
                        </tr>
                    </thead>
                    <tbody id="nutritionTableBody"></tbody>
                </table>
            </div>
 
        </div>
    </div>
</div>
 
<script src="../assets/js/nutrition.js"></script>
 
<?php include("../includes/footer.php"); ?>
 