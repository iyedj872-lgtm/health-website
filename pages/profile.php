<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include("../includes/header.php");
include("../includes/navbar.php");

require_once("../backend/user/get_user.php"); // $user est défini ici
?>

<div class="container mt-5">
    <h2 class="text-center mb-4">👤 My Profile</h2>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card p-4">

                <form method="POST" action="../backend/user/update_user.php">
                    <div class="mb-3">
                        <label for="profileName" class="form-label">Name</label>
                        <input type="text" id="profileName" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="profileEmail" class="form-label">Email</label>
                        <input type="email" id="profileEmail" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-success w-100">Update Profile</button>
                </form>

                <a href="../auth/logout.php" class="btn btn-warning mt-3 w-100">Logout</a>

            </div>
        </div>
    </div>
</div>

<?php include("../includes/footer.php"); ?>