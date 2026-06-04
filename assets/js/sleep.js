document.addEventListener("DOMContentLoaded", function () {

    const sleepForm      = document.getElementById("sleepForm");
    const sleepTableBody = document.getElementById("sleepTableBody");

    if (!sleepForm || !sleepTableBody) return;

    // Charger les données existantes au chargement
    loadSleep();

    // Soumission du formulaire
    sleepForm.addEventListener("submit", function (e) {
        e.preventDefault();

        const date    = document.getElementById("sleepDate").value;
        const hours   = parseFloat(document.getElementById("sleepHours").value);
        const quality = document.getElementById("sleepQuality").value;
        const notes   = document.getElementById("sleepNotes").value;

        if (!date || isNaN(hours) || hours <= 0) {
            showAlert("sleepAlert", "⚠️ Please enter a valid date and hours!", "danger");
            return;
        }

        const formData = new FormData();
        formData.append("date",    date);
        formData.append("hours",   hours);
        formData.append("quality", quality);
        formData.append("notes",   notes);

        fetch("../backend/sleep/add_sleep.php", {
            method: "POST",
            body: formData
        })
        .then(res => res.text())
        .then(text => {
            try {
                const data = JSON.parse(text);
                if (data.success) {
                    showAlert("sleepAlert", "✅ Sleep entry added successfully!", "success");
                    sleepForm.reset();
                    loadSleep();
                } else {
                    showAlert("sleepAlert", "❌ Error: " + (data.message || "Unknown error"), "danger");
                }
            } catch(e) {
                console.error("PHP Error:", text);
                showAlert("sleepAlert", "❌ Server error. Check console (F12).", "danger");
            }
        })
        .catch(err => {
            console.error("Fetch error:", err);
            showAlert("sleepAlert", "❌ Connection error.", "danger");
        });
    });

    // Charger les entrées depuis la base de données
    function loadSleep() {
        fetch("../backend/sleep/get_sleep.php")
        .then(res => res.text())
        .then(text => {
            try {
                const records = JSON.parse(text);
                sleepTableBody.innerHTML = "";

                if (records.length === 0) {
                    sleepTableBody.innerHTML = `<tr><td colspan="5" class="text-center text-muted">No sleep entries yet. Add your first entry! 🌙</td></tr>`;
                    return;
                }

                records.forEach(record => {
                    const row = document.createElement("tr");
                    row.innerHTML = `
                        <td>${record.date}</td>
                        <td>${record.hours} h</td>
                        <td>${record.quality}</td>
                        <td>${record.notes || '-'}</td>
                        <td>${record.advice}</td>
                    `;
                    sleepTableBody.appendChild(row);
                });
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
