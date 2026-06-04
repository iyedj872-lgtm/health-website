document.addEventListener("DOMContentLoaded", function () {

    // Grab form elements
    const form = document.getElementById("calculatorForm");
    const heightInput = document.getElementById("height");
    const weightInput = document.getElementById("weight");
    const resultDiv = document.getElementById("result");

    if (!form || !heightInput || !weightInput || !resultDiv) return;

    form.addEventListener("submit", function (e) {
        e.preventDefault();

        const height = parseFloat(heightInput.value);
        const weight = parseFloat(weightInput.value);

        if (isNaN(height) || isNaN(weight) || height <= 0 || weight <= 0) {
            resultDiv.innerHTML = `<div class="alert alert-danger">Please enter valid height and weight!</div>`;
            return;
        }

        // ---------------------------
        // Calculate BMI
        // BMI = weight (kg) / (height (m))^2
        // ---------------------------
        const heightMeters = height / 100; // convert cm to meters
        const bmi = weight / (heightMeters * heightMeters);

        // ---------------------------
        // Calculate calories (simple BMR estimate)
        // Mifflin-St Jeor Equation (simplified for demo)
        // ---------------------------
        // For demo, assume male, age 25
        const bmr = 10 * weight + 6.25 * height - 5 * 25 + 5; // kcal/day

        // ---------------------------
        // Determine BMI category
        // ---------------------------
        let category = "";
        let advice = "";

        if (bmi < 18.5) {
            category = "Underweight";
            advice = "Try to gain healthy weight with balanced nutrition.";
        } else if (bmi < 24.9) {
            category = "Normal weight";
            advice = "Great! Maintain your healthy lifestyle.";
        } else if (bmi < 29.9) {
            category = "Overweight";
            advice = "Consider regular exercise and balanced diet.";
        } else {
            category = "Obese";
            advice = "Consult a healthcare professional for guidance.";
        }

        // ---------------------------
        // Display result
        // ---------------------------
        resultDiv.innerHTML = `
            <div class="alert alert-info">
                <p><strong>BMI:</strong> ${bmi.toFixed(1)}</p>
                <p><strong>Category:</strong> ${category}</p>
                <p><strong>Estimated Calories Needed:</strong> ${Math.round(bmr)} kcal/day</p>
                <p><strong>Advice:</strong> ${advice}</p>
            </div>
        `;
    });

    // Optional: Real-time update on input change
    [heightInput, weightInput].forEach(input => {
        input.addEventListener("input", function () {
            resultDiv.innerHTML = ""; // clear previous result
        });
    });

});