document.addEventListener("DOMContentLoaded", function () {

    // -----------------------------
    // Example: Display welcome username
    // -----------------------------
    const usernameDisplay = document.getElementById("usernameDisplay");
    if (usernameDisplay) {
        // You can set this dynamically using PHP session
        // Example in PHP: <span id="usernameDisplay"><?php echo $_SESSION['user_name']; ?></span>
        console.log("Profile JS loaded for user:", usernameDisplay.textContent);
    }

    // -----------------------------
    // Update profile form validation
    // -----------------------------
    const profileForm = document.getElementById("profileForm");
    if (profileForm) {
        profileForm.addEventListener("submit", function (e) {
            const email = document.getElementById("profileEmail").value;
            const name = document.getElementById("profileName").value;

            // Simple validation
            if (!email || !name) {
                e.preventDefault();
                alert("Name and Email cannot be empty!");
            }
        });
    }

    // -----------------------------
    // Logout confirmation
    // -----------------------------
    const logoutBtn = document.getElementById("logoutBtn");
    if (logoutBtn) {
        logoutBtn.addEventListener("click", function (e) {
            const confirmLogout = confirm("Are you sure you want to logout?");
            if (!confirmLogout) e.preventDefault();
        });
    }

    // -----------------------------
    // Future: Add more profile interactions here
    // e.g., change password, avatar preview, etc.
    // -----------------------------

});