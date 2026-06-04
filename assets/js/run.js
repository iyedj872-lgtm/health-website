document.addEventListener("DOMContentLoaded", function () {

    const runForm      = document.getElementById("runForm");
    const runTableBody = document.getElementById("runTableBody");

    if (!runForm || !runTableBody) return;

    // Charger les runs existants au chargement de la page
    loadRuns();

    // Soumission du formulaire
    runForm.addEventListener("submit", function (e) {
        e.preventDefault();

        const date     = document.getElementById("runDate").value;
        const distance = parseFloat(document.getElementById("runDistance").value);
        const time     = parseFloat(document.getElementById("runTime").value);
        const company  = document.getElementById("runCompany").value;
        const notes    = document.getElementById("runNotes").value;

        // Validation
        if (!date || isNaN(distance) || isNaN(time) || distance <= 0 || time <= 0) {
            showAlert("runAlert", "⚠️ Please fill all fields correctly!", "danger");
            return;
        }

        const formData = new FormData();
        formData.append("date",     date);
        formData.append("distance", distance);
        formData.append("time",     time);
        formData.append("company",  company);
        formData.append("notes",    notes);

        fetch("../backend/run/add_run.php", {
            method: "POST",
            body: formData
        })
        .then(res => res.text())  // text() d'abord pour voir les erreurs PHP
        .then(text => {
            try {
                const data = JSON.parse(text);
                if (data.success) {
                    showAlert("runAlert", "✅ Run added successfully!", "success");
                    runForm.reset();
                    loadRuns();
                } else {
                    showAlert("runAlert", "❌ Error: " + (data.message || "Unknown error"), "danger");
                }
            } catch(e) {
                // Affiche l'erreur PHP brute dans la console
                console.error("PHP Error:", text);
                showAlert("runAlert", "❌ Server error. Check console (F12).", "danger");
            }
        })
        .catch(err => {
            console.error("Fetch error:", err);
            showAlert("runAlert", "❌ Connection error.", "danger");
        });
    });

    // Charger les runs depuis la base de données
    function loadRuns() {
        fetch("../backend/run/get_runs.php")
        .then(res => res.text())
        .then(text => {
            try {
                const runs = JSON.parse(text);
                runTableBody.innerHTML = "";

                if (runs.length === 0) {
                    runTableBody.innerHTML = `<tr><td colspan="7" class="text-center text-muted">No runs yet. Add your first run! 🏃</td></tr>`;
                    return;
                }

                runs.forEach(run => {
                    const pace = run.pace ? parseFloat(run.pace).toFixed(2) : (run.time / run.distance).toFixed(2);
                    const row  = document.createElement("tr");
                    row.innerHTML = `
                        <td>${run.date}</td>
                        <td>${run.distance} km</td>
                        <td>${run.time} min</td>
                        <td>${pace} min/km</td>
                        <td>${run.company || '-'}</td>
                        <td>${run.notes || '-'}</td>
                        <td>
                            <button class="btn btn-danger btn-sm" onclick="deleteRun(${run.id})">🗑 Delete</button>
                        </td>
                    `;
                    runTableBody.appendChild(row);
                });
            } catch(e) {
                console.error("Load error:", text);
            }
        });
    }

    // Supprimer un run
    window.deleteRun = function(id) {
        if (!confirm("Are you sure you want to delete this run?")) return;
        fetch(`../backend/run/delete_run.php?id=${id}`)
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                showAlert("runAlert", "✅ Run deleted!", "success");
                loadRuns();
            }
        });
    };

    // Afficher une alerte
    function showAlert(divId, message, type) {
        const div = document.getElementById(divId);
        if (!div) return;
        div.innerHTML = `<div class="alert alert-${type} mt-2">${message}</div>`;
        setTimeout(() => { div.innerHTML = ""; }, 4000);
    }

});
