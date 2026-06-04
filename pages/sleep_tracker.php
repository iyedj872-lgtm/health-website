<?php
include("../includes/header.php");
include("../includes/navbar.php");
?>
 
<div class="container mt-5">
    <h2 class="text-center mb-4">🌙 Sleep Tracker</h2>
 
    <div id="sleepAlert"></div>
 
    <div class="row justify-content-center">
        <div class="col-md-6">
 
            <div class="card p-4">
                <form id="sleepForm">
                    <div class="mb-2">
                        <label class="form-label">Date</label>
                        <input type="date" id="sleepDate" name="date" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Hours Slept</label>
                        <input type="number" step="0.1" id="sleepHours" name="hours" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Sleep Quality</label>
                        <select id="sleepQuality" name="quality" class="form-control">
                            <option value="Poor">Poor</option>
                            <option value="Average">Average</option>
                            <option value="Good">Good</option>
                            <option value="Excellent">Excellent</option>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Notes</label>
                        <textarea id="sleepNotes" name="notes" class="form-control" rows="2"></textarea>
                    </div>
                    <button type="submit" class="btn btn-success w-100">Add Sleep Entry</button>
                </form>
            </div>
 
            <!-- Sleep History Table -->
            <div class="mt-4">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Hours</th>
                            <th>Quality</th>
                            <th>Notes</th>
                            <th>Advice</th>
                        </tr>
                    </thead>
                    <tbody id="sleepTableBody"></tbody>
                </table>
            </div>
 
        </div>
    </div>
</div>
 
<script src="../assets/js/sleep.js"></script>
 
<?php include("../includes/footer.php"); ?>