<?php
session_start();
$toast = '';
$toastType = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $conn = new mysqli("localhost", "root", "", "studyspace", 3307);

  $email = $_POST['email'];
  $password = $_POST['password'];

  $result = $conn->query("SELECT * FROM users WHERE email='$email'");
  if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    if (password_verify($password, $user['password'])) {
      $_SESSION['username'] = $user['name'];
      header("Location: dashboard.php");
      exit();
    } else {
      $toast = "Incorrect password.";
      $toastType = 'danger';
    }
  } else {
    $toast = "No user found with that email.";
    $toastType = 'danger';
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login | StudySpace</title>
  <link rel="stylesheet" href="style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="overlay"></div>

<nav class="navbar navbar-expand-lg navbar-dark bg-transparent px-4 w-100">
  <a class="navbar-brand d-flex align-items-center" href="index.html">
    <img src="logo-white.png" alt="StudySpace Logo" style="height: 60px; margin-right: 12px;">
    <span class="studyspace-logo">Study<span>Space</span></span>
  </a>

  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
    <ul class="navbar-nav">
    <li class="nav-item"><a class="nav-link text-white" href="index.html">Home</a></li>
      <li class="nav-item"><a class="nav-link text-white" href="notes.html">Notes</a></li>
      <li class="nav-item"><a class="nav-link text-white" href="planner.html">Planner</a></li>
      <li class="nav-item"><a class="nav-link text-white" href="pomodoro.html">Pomodoro</a></li>
      <li class="nav-item"><a class="nav-link text-white" href="dashboard.php">Profile</a></li>

      <li class="nav-item"><a class="nav-link text-white" href="contact.html">Contact</a></li>
      <li class="nav-item"><a class="btn btn-light ms-2" href="register.php">Sign Up</a></li>
    </ul>
  </div>
</nav>

<div class="split-container">
  <!-- LEFT SIDE: Welcome Text -->
  <div class="left-pane">
    <div class="welcome-text">
      <h1>Welcome back to StudySpace</h1>
      <p>Login to unlock your dashboard, notes, schedule, and focus tools — everything you need to slay your semester.</p>
    </div>
  </div>

  <!-- RIGHT SIDE: Login Form -->
  <div class="right-pane">
    <form method="POST">
      <p style="text-align: center; color: #fff;">Don't have an account? <a href="register.php" style="color: #a6e1ff;">Register</a></p>
      <h2 class="fade-item fade-delay-1">Login</h2>

<input type="email" name="email" placeholder="Email" class="glass-input fade-item fade-delay-2" required>
<input type="password" name="password" placeholder="Password" class="glass-input fade-item fade-delay-3" required>

<button type="submit" class="fade-item fade-delay-4">Login</button>


      <div class="form-footer">
        <label><input type="checkbox"> Remember Me</label>
        <span><a href="#" class="text-decoration-none text-light">Forgot password?</a></span>
      </div>
    </form>
  </div>
</div>

<?php if (!empty($toast)): ?>
  <div class="toast-container position-fixed top-0 end-0 p-3">
    <div class="toast show align-items-center text-bg-<?= $toastType ?> border-0" role="alert">
      <div class="d-flex">
        <div class="toast-body"><?= htmlspecialchars($toast) ?></div>
        <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast"></button>
      </div>
    </div>
  </div>
<?php endif; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
