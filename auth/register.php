<?php 
session_start();
include("../includes/header.php"); 
include("../includes/navbar.php"); 
include("../config/db.php");

$error = "";

if(isset($_POST['register'])){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Check if email exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0){
        $error = "Email already registered!";
    } else {
        $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $password);
        $stmt->execute();

        $_SESSION['user_id'] = $stmt->insert_id;
        $_SESSION['user_name'] = $name;

        header("Location: home.php");
        exit;
    }
}
?>

<div class="container mt-5">
    <h2 class="text-center mb-4">📝 Register</h2>

    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card p-4">

                <?php if($error != ""): ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php endif; ?>

                <form method="POST" action="register.php">
                    <div class="mb-2">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <div class="mb-2">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <div class="mb-2">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <button type="submit" name="register" class="btn btn-success w-100">Register</button>
                    <p class="mt-3 text-center">Already have an account? 
                        <a href="login.php">Login here</a>
                    </p>
                </form>

            </div>
        </div>
    </div>
</div>

<?php include("../includes/footer.php"); ?>