document.addEventListener("DOMContentLoaded", function () {

    const nutritionForm      = document.getElementById("nutritionForm");
    const nutritionTableBody = document.getElementById("nutritionTableBody");
    const totalCaloriesDiv   = document.getElementById("totalCalories");
    const totalWaterDiv      = document.getElementById("totalWater");

    if (!nutritionForm || !nutritionTableBody) return;

    // Charger les données existantes au chargement
    loadNutrition();

    // Soumission du formulaire
    nutritionForm.addEventListener("submit", function (e) {
        e.preventDefault();

        const meal_name = document.getElementById("mealName").value;
        const calories  = parseInt(document.getElementById("mealCalories").value);
        const water     = parseFloat(document.getElementById("waterIntake").value);
        const notes     = document.getElementById("nutritionNotes").value;

        if (!meal_name || isNaN(calories) || calories <= 0 || isNaN(water) || water < 0) {
            showAlert("nutritionAlert", "⚠️ Please enter valid meal and water intake!", "danger");
            return;
        }

        const formData = new FormData();
        formData.append("meal_name", meal_name);
        formData.append("calories",  calories);
        formData.append("water",     water);
        formData.append("notes",     notes);

        fetch("../backend/nutrition/add_food.php", {
            method: "POST",
            body: formData
        })
        .then(res => res.text())
        .then(text => {
            try {
                const data = JSON.parse(text);
                if (data.success) {
                    showAlert("nutritionAlert", "✅ Entry added successfully!", "success");
                    nutritionForm.reset();
                    loadNutrition();
                } else {
                    showAlert("nutritionAlert", "❌ Error: " + (data.message || "Unknown error"), "danger");
                }
            } catch(e) {
                console.error("PHP Error:", text);
                showAlert("nutritionAlert", "❌ Server error. Check console (F12).", "danger");
            }
        })
        .catch(err => {
            console.error("Fetch error:", err);
            showAlert("nutritionAlert", "❌ Connection error.", "danger");
        });
    });

    // Charger les entrées depuis la base de données
    function loadNutrition() {
        fetch("../backend/nutrition/get_food.php")
        .then(res => res.text())
        .then(text => {
            try {
                const records = JSON.parse(text);
                nutritionTableBody.innerHTML = "";
                let totalCal   = 0;
                let totalWater = 0;

                if (records.length === 0) {
                    nutritionTableBody.innerHTML = `<tr><td colspan="4" class="text-center text-muted">No entries yet. Add your first meal! 🍎</td></tr>`;
                    if (totalCaloriesDiv) totalCaloriesDiv.textContent = "Total Calories: 0 kcal";
                    if (totalWaterDiv)    totalWaterDiv.textContent    = "Total Water: 0.00 L";
                    return;
                }

                records.forEach(record => {
                    totalCal   += parseFloat(record.calories);
                    totalWater += parseFloat(record.water);

                    const row = document.createElement("tr");
                    row.innerHTML = `
                        <td>${record.meal_name}</td>
                        <td>${record.calories} kcal</td>
                        <td>${record.water} L</td>
                        <td>${record.notes || '-'}</td>
                    `;
                    nutritionTableBody.appendChild(row);
                });

                if (totalCaloriesDiv) totalCaloriesDiv.textContent = `Total Calories: ${totalCal} kcal`;
                if (totalWaterDiv)    totalWaterDiv.textContent    = `Total Water: ${totalWater.toFixed(2)} L`;

            } catch(e) {
                console.error("Load error:", text);
            }
        });
    }

    // Afficher une alerte
    function showAlert(divId, message, type) {
        const div = document.getElementById(divId);
        if (!div) return;
        div.innerHTML = `<div class="alert alert-${type} mt-2">${message}</div>`;
        setTimeout(() => { div.innerHTML = ""; }, 4000);
    }

});
