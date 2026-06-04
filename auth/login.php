<?php 
session_start();
include("../includes/header.php"); 
include("../includes/navbar.php"); 
include("../config/db.php");

// Redirect if already logged in
if(isset($_SESSION['user_id'])){
    header("Location: home.php");
    exit;
}

$error = "";

if(isset($_POST['login'])){

    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if($user){
        if(password_verify($password, $user['password'])){
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            header("Location: ../index.php"); // or index.php
            exit;
        } else {
            $error = "Incorrect password!";
        }
    } else {
        $error = "Email not found!";
    }
}

?>

<div class="container mt-5">
    <h2 class="text-center mb-4">🔐 Login</h2>

    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card p-4">

                <?php if($error != ""): ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php endif; ?>

                <form method="POST" action="login.php">
                    <div class="mb-2">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <div class="mb-2">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <button type="submit" name="login" class="btn btn-primary w-100">Login</button>
                    <p class="mt-3 text-center">Don't have an account? 
                        <a href="register.php">Register here</a>
                    </p>
                </form>

            </div>
        </div>
    </div>
</div>

<?php include("../includes/footer.php"); ?>