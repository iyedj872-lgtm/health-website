<?php
include("../includes/header.php");
include("../includes/navbar.php");
?>

<div class="container mt-5">
    <h2 class="text-center mb-4">🏃‍♂️ Run Tracker</h2>

    <!-- Zone d'alerte -->
    <div id="runAlert"></div>

    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card p-4">
                <form id="runForm">

                    <div class="mb-2">
                        <label class="form-label">Date</label>
                        <input type="date" id="runDate" name="date" class="form-control" required>
                    </div>

                    <div class="mb-2">
                        <label class="form-label">Distance (km)</label>
                        <input type="number" step="0.01" id="runDistance" name="distance" class="form-control" placeholder="ex: 5.5" required>
                    </div>

                    <div class="mb-2">
                        <label class="form-label">Time (minutes)</label>
                        <input type="number" step="1" id="runTime" name="time" class="form-control" placeholder="ex: 30" required>
                    </div>

                    <div class="mb-2">
                        <label class="form-label">Company</label>
                        <select id="runCompany" name="company" class="form-control">
                            <option value="Alone">Alone</option>
                            <option value="With Company">With Company</option>
                        </select>
                    </div>

                    <div class="mb-2">
                        <label class="form-label">Notes</label>
                        <textarea id="runNotes" name="notes" class="form-control" rows="2" placeholder="Optional notes..."></textarea>
                    </div>

                    <button type="submit" class="btn btn-success w-100 mt-2">➕ Add Run</button>
                </form>
            </div>

            <!-- Tableau historique -->
            <div class="mt-4">
                <h5>📋 Run History</h5>
                <table class="table table-striped table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>Date</th>
                            <th>Distance</th>
                            <th>Time</th>
                            <th>Pace</th>
                            <th>Company</th>
                            <th>Notes</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="runTableBody">
                        <tr><td colspan="7" class="text-center text-muted">Loading...</td></tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

<script src="../assets/js/run.js"></script>

<?php include("../includes/footer.php"); ?>
