<?php
include("../includes/header.php");
include("../includes/navbar.php");
?>

<div class="container mt-5">
    <h2 class="text-center mb-4">📩 Contact Us</h2>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card p-4">

                <form method="POST" action="../backend/contact/add_contact.php">

                    <div class="mb-2">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <div class="mb-2">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <div class="mb-2">
                        <label>Message</label>
                        <textarea name="message" class="form-control" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                        Send Message
                    </button>

                </form>

            </div>
        </div>
    </div>
</div>

<?php include("../includes/footer.php"); ?>