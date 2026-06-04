<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <!-- Logo / Home -->
    <a class="navbar-brand" href="/pages/home.php">Healthy Life</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link" href="/pages/calculator.php">Calculator</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/pages/gym.php">Gym</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/pages/run_tracker.php">Run Tracker</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/pages/sleep_tracker.php">Sleep Tracker</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/pages/nutrition.php">Nutrition</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/pages/contact.php">Contact Us</a>
        </li>

        <?php if(isset($_SESSION['user_id'])): ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown"
              aria-expanded="false">
              Profile
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
              <li><a class="dropdown-item" href="/pages/profile.php">My Profile</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="/backend/auth/logout.php">Logout</a></li>
            </ul>
          </li>
        <?php else: ?>
          <li class="nav-item">
            <a class="nav-link" href="/pages/login.php">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/pages/register.php">Register</a>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>